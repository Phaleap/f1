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
}
