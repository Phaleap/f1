<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CartController extends Controller
{
    private function authUser(): User
    {
        return Auth::user();
    }

    public function index()
    {
        $cart  = $this->authUser()->cart;
        $items = $cart ? $cart->items()->with(['product.mainImage', 'variant'])->get() : collect();
        $total = $items->sum(fn($item) => ($item->unit_price) * $item->quantity);

        return view('cart.index', compact('items', 'total'));
    }

    public function add(Request $request, Product $product)
    {
        $request->validate([
            'variant_id' => 'nullable|exists:product_variants,variant_id',
            'quantity'   => 'nullable|integer|min:1',
        ]);

        $user     = $this->authUser();
        $cart     = $user->cart ?? Cart::create(['user_id' => $user->id]);
        $quantity = $request->quantity ?? 1;

        // Calculate price (base + variant extra)
        $price = $product->base_price;
        if ($request->filled('variant_id')) {
            $variant = ProductVariant::find($request->variant_id);
            $price  += $variant->extra_price ?? 0;
        }

        // Check if same product+variant already in cart
        $item = $cart->items()
            ->where('product_id', $product->id)
            ->where('variant_id', $request->variant_id)
            ->first();

        if ($item) {
            $item->increment('quantity', $quantity);
        } else {
            $cart->items()->create([
                'product_id' => $product->id,
                'variant_id' => $request->variant_id,
                'quantity'   => $quantity,
                'unit_price' => $price,
                'added_at'   => now(),
            ]);
        }

        return back()->with('success', $product->product_name . ' added to cart!');
    }

    public function update(Request $request, CartItem $item)
    {
        $request->validate(['quantity' => 'required|integer|min:1']);
        $item->update(['quantity' => $request->quantity]);

        return back()->with('success', 'Cart updated.');
    }

    public function remove(CartItem $item)
    {
        $item->delete();
        return back()->with('success', 'Item removed from cart.');
    }
}
