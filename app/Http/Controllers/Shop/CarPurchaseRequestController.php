<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Models\CarPurchaseRequest;
use App\Models\Product;
use App\Services\TelegramService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CarPurchaseRequestController extends Controller
{
    public function create($productId)
    {
        $product = Product::findOrFail($productId);

        if (!$product->isCarProduct()) {
            abort(403, 'This product does not require a purchase request.');
        }

        return view('shop.car-request.create', compact('product'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id'         => 'required|exists:products,id',
            'full_name'          => 'required|string|max:255',
            'phone'              => 'required|string|max:20',
            'message'            => 'nullable|string',
            'payment_preference' => 'required|in:online,walk_in',
        ]);

        // Only block if there's an unreviewed pending request
        $existing = CarPurchaseRequest::where('user_id', Auth::id())
            ->where('product_id', $request->product_id)
            ->where('request_status', 'pending')
            ->first();

        if ($existing) {
            return back()->with('error', 'You already have a pending request for this car. Please wait for our team to review it.');
        }

        $product = Product::findOrFail($request->product_id);

        $carRequest = CarPurchaseRequest::create([
            'user_id'            => Auth::id(),
            'product_id'         => $request->product_id,
            'full_name'          => $request->full_name,
            'phone'              => $request->phone,
            'message'            => $request->message,
            'payment_preference' => $request->payment_preference,
            'request_status'     => 'pending',
        ]);

        try {
            $telegram = new TelegramService();
            $telegram->notifyAdmin(
                "🏎 <b>New Car Purchase Request</b>\n\n" .
                "👤 Customer: {$request->full_name}\n" .
                "📞 Phone: {$request->phone}\n" .
                "🚗 Car: {$product->product_name}\n" .
                "💳 Payment: " . ucfirst(str_replace('_', ' ', $request->payment_preference)) . "\n" .
                "📋 Request ID: #{$carRequest->request_id}\n\n" .
                "👉 Review at: " . url('/admin/car-requests/' . $carRequest->request_id)
            );
        } catch (\Exception $e) {
            // Silently fail
        }

        return redirect()->route('shop.car-request.my-requests')
            ->with('success', 'Your request has been submitted! We will review it shortly.');
    }

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
        abort_if($carRequest->user_id !== Auth::id(), 403);
        abort_if($carRequest->request_status !== 'approved', 403);
        abort_if($carRequest->payment_preference !== 'online', 403);

        $carRequest->load([
            'product.images',
            'product.carModel.team',
            'product.carModel.driver',
            'carOrder',
        ]);

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

        try {
            $telegram = new TelegramService();
            $carRequest->load('product');
            $telegram->notifyAdmin(
                "💰 <b>Car Payment Received</b>\n\n" .
                "👤 Customer: {$carRequest->full_name}\n" .
                "🚗 Car: {$carRequest->product->product_name}\n" .
                "💳 Method: " . ucfirst($request->payment_method) . "\n" .
                "🔖 Ref: {$txRef}\n\n" .
                "👉 View at: " . url('/admin/car-orders/' . $carOrder->car_order_id)
            );
        } catch (\Exception $e) {
            // Silently fail
        }

        return response()->json([
            'success'         => true,
            'transaction_ref' => $txRef,
        ]);
    }
}