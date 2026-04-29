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
   public function payPage(CarPurchaseRequest $carRequest)
{
    // Guard checks
    abort_if($carRequest->user_id !== Auth::id(), 403);
    abort_if($carRequest->request_status !== 'approved', 403);  // ← request_status not status
    abort_if($carRequest->payment_preference !== 'online', 403);

    $carRequest->load([
        'product.images',
        'product.carModel.team',
        'product.carModel.driver',
        'carOrder',  // ← we need the car_order for payment
    ]);

    // Guard: car order must exist
    abort_if(!$carRequest->carOrder, 404);

    return view('shop.car-request.pay', compact('carRequest'));
}

public function processPayment(Request $request, CarPurchaseRequest $carRequest)
{
    abort_if($carRequest->user_id !== Auth::id(), 403);
    abort_if($carRequest->request_status !== 'approved', 403);
    abort_if($carRequest->payment_preference !== 'online', 403);

    $carOrder = $carRequest->carOrder;
    abort_if(!$carOrder, 404);

    if ($carOrder->car_order_status === 'paid') {
        return response()->json(['error' => 'Already paid.'], 400);
    }

    // Map method name to payment_method_id
    $methodMap = ['card' => 1, 'bank' => 3, 'crypto' => null];
    $paymentMethodId = $methodMap[$request->payment_method] ?? 1;

    $txRef = 'TXN-' . strtoupper(substr(md5($carOrder->car_order_id . time()), 0, 10));

    $carOrder->update([
        'car_order_status'     => 'paid',
        'payment_method_id'    => $paymentMethodId,
        'transaction_code'     => $txRef,
        'payment_confirmed_at' => now(),
        'payment_notes'        => 'Paid online via ' . $request->payment_method,
    ]);

    \App\Models\CarOrderStatusHistory::create([
        'car_order_id' => $carOrder->car_order_id,
        'status'       => 'paid',
        'changed_by'   => Auth::id(),
        'changed_at'   => now(),
        'remarks'      => 'Online payment completed. Ref: ' . $txRef,
    ]);

    return response()->json([
        'success'         => true,
        'transaction_ref' => $txRef,
    ]);
}
}