<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'rating'     => 'required|integer|min:1|max:5',
            'comment'    => 'nullable|string|max:1000',
        ]);

        // Only allow review if user has ordered and received the product
        $hasPurchased = Order::where('user_id', Auth::id())
            ->where('order_status', 'delivered')
            ->whereHas('items', fn($q) => $q->where('product_id', $request->product_id))
            ->exists();

        if (!$hasPurchased) {
            return back()->with('error', 'You can only review products you have purchased.');
        }

        // One review per product per user
        $alreadyReviewed = Review::where('user_id', Auth::id())
            ->where('product_id', $request->product_id)
            ->exists();

        if ($alreadyReviewed) {
            return back()->with('error', 'You have already reviewed this product.');
        }

        Review::create([
            'user_id'       => Auth::id(),
            'product_id'    => $request->product_id,
            'rating'        => $request->rating,
            'comment'       => $request->comment,
            'review_status' => 'visible',
            'created_at'    => now(),
        ]);

        return back()->with('success', 'Review submitted.');
    }

    public function destroy(Review $review)
    {
        if ($review->user_id !== Auth::id()) {
            abort(403);
        }

        $review->delete();

        return back()->with('success', 'Review deleted.');
    }
}
