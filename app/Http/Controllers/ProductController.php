<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Team;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Product listing with filters
    public function index(Request $request)
    {
        $query = Product::with(['mainImage', 'brand', 'category', 'inventory'])
            ->where('status', 'active');

        // Filter by type: car or merchandise
        if ($request->filled('type')) {
            $query->where('product_type', $request->type);
        }

        // Filter by category
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        // Filter by brand
        if ($request->filled('brand')) {
            $query->where('brand_id', $request->brand);
        }

        // Filter by team (via car_model)
        if ($request->filled('team')) {
            $query->whereHas('carModel', function ($q) use ($request) {
                $q->where('team_id', $request->team);
            });
        }

        // Price range
        if ($request->filled('min_price')) {
            $query->where('base_price', '>=', $request->min_price);
        }
        if ($request->filled('max_price')) {
            $query->where('base_price', '<=', $request->max_price);
        }

        // Search
        if ($request->filled('search')) {
            $query->where('product_name', 'like', '%' . $request->search . '%');
        }

        // Sort
        match($request->sort) {
            'price_asc'  => $query->orderBy('base_price', 'asc'),
            'price_desc' => $query->orderBy('base_price', 'desc'),
            'newest'     => $query->orderBy('created_at', 'desc'),
            default      => $query->orderBy('created_at', 'desc'),
        };

        $products   = $query->paginate(12)->withQueryString();
        $categories = Category::whereNull('parent_category_id')->with('children')->get();
        $brands     = Brand::all();
        $teams      = Team::all();

        return view('products.index', compact('products', 'categories', 'brands', 'teams'));
    }

    // Single product detail
    public function show(Product $product)
    {
        if ($product->status !== 'active') {
            abort(404);
        }

        $product->load([
            'images',
            'variants',
            'brand',
            'category',
            'carModel.team',
            'carModel.driver',
            'warranty',
            'reviews.user',
            'discounts',
            'promotions',
        ]);

        // Get stock info
        $inventory = $product->inventory()->with('variant')->get();

        // Related products — same category, exclude current
        $related = Product::with('mainImage')
            ->where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->where('status', 'active')
            ->limit(4)
            ->get();

        return view('products.show', compact('product', 'inventory', 'related'));
    }

    // Cars only
    public function cars(Request $request)
    {
        $request->merge(['type' => 'car']);
        return $this->index($request);
    }

    // Merchandise only
    public function merchandise(Request $request)
    {
        $request->merge(['type' => 'merchandise']);
        return $this->index($request);
    }
   public function shop()
{
    // Section 1 — Featured cars with driver (hero showcase)
    $featuredCars = Product::with([
        'mainImage',
        'carModel.team',
        'carModel.driver',
    ])
    ->where('status', 'active')
    ->where('product_type', 'car')
    ->where('is_featured', true)  // ← this line
    ->take(3)
    ->get();

    // Section 2 — All cars grid (paginated)
    $allCars = Product::with([
            'mainImage',
            'carModel.team',
            'carModel.driver',
        ])
        ->where('status', 'active')
        ->where('product_type', 'car')
        ->latest()
        ->paginate(9, ['*'], 'cars_page');

    // Section 3 — Merchandise (paginated, load all for client-side category filter)
    // Using a high perPage so category filter works client-side without pagination resets
    $merchandise = Product::with(['mainImage', 'category', 'brand'])
        ->where('status', 'active')
        ->where('product_type', 'merchandise')
        ->latest()
        ->paginate(48, ['*'], 'merch_page');

    // Merchandise categories — only categories that actually have active merch products
    $merchCategories = \App\Models\Category::whereHas('products', function ($q) {
            $q->where('status', 'active')->where('product_type', 'merchandise');
        })
        ->whereNull('parent_category_id') // top-level only
        ->orderBy('category_name')
        ->get();

    return view('shop.index', compact('featuredCars', 'allCars', 'merchandise', 'merchCategories'));
}
}
