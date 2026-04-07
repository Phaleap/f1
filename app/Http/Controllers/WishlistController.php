<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use App\Models\WishlistItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{


    public function index()
    {
        $wishlist = Wishlist::with('items.product.mainImage')
            ->firstOrCreate(['user_id' => Auth::id()]);

        return view('wishlist.index', compact('wishlist'));
    }

    public function add(Request $request)
    {
        $request->validate(['product_id' => 'required|exists:products,id']);

        $wishlist = Wishlist::firstOrCreate(['user_id' => Auth::id()]);

        // Don't add duplicate
        $exists = WishlistItem::where('wishlist_id', $wishlist->wishlist_id)
            ->where('product_id', $request->product_id)
            ->exists();

        if (!$exists) {
            WishlistItem::create([
                'wishlist_id' => $wishlist->wishlist_id,
                'product_id'  => $request->product_id,
                'added_at'    => now(),
            ]);
        }

        return back()->with('success', 'Added to wishlist.');
    }

    public function remove(WishlistItem $item)
    {
        // Make sure it belongs to the auth user
        if ($item->wishlist->user_id !== Auth::id()) {
            abort(403);
        }

        $item->delete();

        return back()->with('success', 'Removed from wishlist.');
    }
}
