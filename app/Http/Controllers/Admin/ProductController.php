<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Supplier;
use App\Models\Warranty;
use App\Models\CarModel;
use App\Models\ProductImage;
use App\Models\ProductVariant;
use App\Models\Inventory;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with(['category', 'brand', 'mainImage'])
            ->latest()
            ->paginate(20);

        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        $brands     = Brand::all();
        $suppliers  = Supplier::all();
        $warranties = Warranty::all();
        $carModels  = CarModel::with('team')->get();

        return view('admin.products.create', compact(
            'categories', 'brands', 'suppliers', 'warranties', 'carModels'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_name' => 'required|string|max:255',
            'category_id'  => 'required|exists:categories,id',
            'base_price'   => 'required|numeric|min:0',
            'product_type' => 'required|in:car,merchandise',
            'sku'          => 'required|unique:products,sku',
            'status'       => 'required|in:active,inactive',
        ]);

        $data = $request->except('images', 'variants', 'stock');
        $data['is_featured'] = $request->has('is_featured');
        $product = Product::create($data);

        // Handle images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $image) {
                $path = $image->store('products', 'public');
                ProductImage::create([
                    'product_id' => $product->id,
                    'image_url'  => $path,
                    'is_main'    => $index === 0,
                    'sort_order' => $index + 1,
                    'created_at' => now(),
                ]);
            }
        }

        // Handle variants
        if ($request->filled('variants')) {
            foreach ($request->variants as $variant) {
                if (empty($variant['name'])) continue;

                $v = ProductVariant::create([
                    'product_id'   => $product->id,
                    'variant_name' => $variant['name'],
                    'size'         => $variant['size'] ?? null,
                    'color'        => $variant['color'] ?? null,
                    'extra_price'  => $variant['extra_price'] ?? 0,
                    'sku'          => $variant['sku'] ?? null,
                    'status'       => 'active',
                    'created_at'   => now(),
                ]);

                Inventory::create([
                    'product_id'     => $product->id,
                    'variant_id'     => $v->variant_id,
                    'stock_quantity' => $variant['stock'] ?? 0,
                    'minimum_stock'  => 5,
                    'last_updated'   => now(),
                ]);
            }
        } else {
            // No variants — single inventory record
            Inventory::create([
                'product_id'     => $product->id,
                'variant_id'     => null,
                'stock_quantity' => $request->stock ?? 0,
                'minimum_stock'  => 5,
                'last_updated'   => now(),
            ]);
        }

        return redirect()->route('admin.products.index')
            ->with('success', 'Product created.');
    }

    public function edit(Product $product)
    {
        $product->load(['images', 'variants.inventory', 'inventory']);
        $categories = Category::all();
        $brands     = Brand::all();
        $suppliers  = Supplier::all();
        $warranties = Warranty::all();
        $carModels  = CarModel::with('team')->get();

        return view('admin.products.edit', compact(
            'product', 'categories', 'brands', 'suppliers', 'warranties', 'carModels'
        ));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'product_name' => 'required|string|max:255',
            'category_id'  => 'required|exists:categories,id',
            'base_price'   => 'required|numeric|min:0',
            'product_type' => 'required|in:car,merchandise',
            'sku'          => 'required|unique:products,sku,' . $product->id,
            'status'       => 'required|in:active,inactive',
        ]);

        $data = $request->except('images', 'variants', 'existing_variants', 'stock');
        $data['is_featured'] = $request->has('is_featured');
        $product->update($data);

        // Handle new images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $image) {
                $path = $image->store('products', 'public');
                ProductImage::create([
                    'product_id' => $product->id,
                    'image_url'  => $path,
                    'is_main'    => false,
                    'sort_order' => $product->images()->count() + $index + 1,
                    'created_at' => now(),
                ]);
            }
        }

        // Update base stock (no variants)
        if ($request->has('stock')) {
            $inv = $product->inventory()->whereNull('variant_id')->first();
            if ($inv) {
                $inv->update([
                    'stock_quantity' => $request->stock,
                    'last_updated'   => now(),
                ]);
            } else {
                Inventory::create([
                    'product_id'     => $product->id,
                    'variant_id'     => null,
                    'stock_quantity' => $request->stock ?? 0,
                    'minimum_stock'  => 5,
                    'last_updated'   => now(),
                ]);
            }
        }

        // Update existing variants
        if ($request->filled('existing_variants')) {
            foreach ($request->existing_variants as $variantId => $data) {
                $variant = ProductVariant::find($variantId);
                if (!$variant) continue;

                $variant->update([
                    'variant_name' => $data['name'],
                    'sku'          => $data['sku'] ?? $variant->sku,
                    'size'         => $data['size'] ?? null,
                    'color'        => $data['color'] ?? null,
                    'extra_price'  => $data['extra_price'] ?? 0,
                ]);

                // Update or create inventory for this variant
                $inv = $variant->inventory()->first();
                if ($inv) {
                    $inv->update([
                        'stock_quantity' => $data['stock'] ?? 0,
                        'last_updated'   => now(),
                    ]);
                } else {
                    Inventory::create([
                        'product_id'     => $product->id,
                        'variant_id'     => $variant->variant_id,
                        'stock_quantity' => $data['stock'] ?? 0,
                        'minimum_stock'  => 5,
                        'last_updated'   => now(),
                    ]);
                }
            }
        }

        // Add new variants
        if ($request->filled('variants')) {
            foreach ($request->variants as $variantData) {
                if (empty($variantData['name'])) continue;

                $variant = ProductVariant::create([
                    'product_id'   => $product->id,
                    'variant_name' => $variantData['name'],
                    'sku'          => $variantData['sku'] ?? null,
                    'size'         => $variantData['size'] ?? null,
                    'color'        => $variantData['color'] ?? null,
                    'extra_price'  => $variantData['extra_price'] ?? 0,
                    'status'       => 'active',
                    'created_at'   => now(),
                ]);

                Inventory::create([
                    'product_id'     => $product->id,
                    'variant_id'     => $variant->variant_id,
                    'stock_quantity' => $variantData['stock'] ?? 0,
                    'minimum_stock'  => 5,
                    'last_updated'   => now(),
                ]);
            }
        }

        return redirect()->route('admin.products.index')
            ->with('success', 'Product updated.');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('admin.products.index')
            ->with('success', 'Product deleted.');
    }

    public function deleteImage(ProductImage $image)
    {
        $image->delete();
        return back()->with('success', 'Image removed.');
    }

    public function toggleFeatured(Product $product)
    {
        $newValue = !$product->is_featured;
        $product->update(['is_featured' => $newValue]);
        return back()->with('success',
            $newValue ? '★ Added to hero showcase.' : 'Removed from hero.'
        );
    }
}