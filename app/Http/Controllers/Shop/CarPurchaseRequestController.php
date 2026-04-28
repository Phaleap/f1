<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Models\CarPurchaseRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CarPurchaseRequestController extends Controller
{
    // Show request form
    public function create($productId)
    {
        $product = Product::findOrFail($productId);

        // Block if not a car product
        if (!$product->isCarProduct()) {
            abort(403, 'This product does not require a purchase request.');
        }

        return view('shop.car-request.create', compact('product'));
    }

    // Submit request
    public function store(Request $request)
    {
        $request->validate([
            'product_id'         => 'required|exists:products,id',
            'full_name'          => 'required|string|max:255',
            'phone'              => 'required|string|max:20',
            'message'            => 'nullable|string',
            'payment_preference' => 'required|in:online,walk_in',
        ]);

        // Check if user already has a pending request for this car
        $existing = CarPurchaseRequest::where('user_id', Auth::id())
            ->where('product_id', $request->product_id)
            ->whereIn('request_status', ['pending', 'approved'])
            ->first();

        if ($existing) {
            return back()->with('error', 'You already have an active request for this car.');
        }

        CarPurchaseRequest::create([
            'user_id'            => Auth::id(),
            'product_id'         => $request->product_id,
            'full_name'          => $request->full_name,
            'phone'              => $request->phone,
            'message'            => $request->message,
            'payment_preference' => $request->payment_preference,
            'request_status'     => 'pending',
        ]);

        return redirect()->route('shop.car-request.my-requests')
            ->with('success', 'Your request has been submitted! We will review it shortly.');
    }

    // User's own requests list
    public function myRequests()
    {
        $requests = CarPurchaseRequest::where('user_id', Auth::id())
            ->with(['product', 'carOrder'])
            ->latest()
            ->get();

        return view('shop.car-request.my-requests', compact('requests'));
    }
}