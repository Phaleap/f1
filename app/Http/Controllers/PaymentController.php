<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Payment;
use App\Models\PaymentMethod;
use App\Models\OrderStatusHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{

    public function show(Order $order)
    {
        if ($order->user_id !== Auth::id()) abort(403);

        $paymentMethods = PaymentMethod::where('status', 'active')->get();

        return view('payment.show', compact('order', 'paymentMethods'));
    }

    public function process(Request $request, Order $order)
    {
        if ($order->user_id !== Auth::id()) abort(403);

        $request->validate([
            'payment_method_id' => 'required|exists:payment_methods,payment_method_id',
        ]);

        // Create payment record
        Payment::create([
            'order_id'          => $order->id,
            'payment_method_id' => $request->payment_method_id,
            'amount'            => $order->total_amount,
            'payment_status'    => 'paid',
            'payment_date'      => now(),
        ]);

        // Update order status
        $order->update(['order_status' => 'processing']);

        // Log status change
        OrderStatusHistory::create([
            'order_id'   => $order->id,
            'status'     => 'processing',
            'changed_by' => Auth::id(),
            'changed_at' => now(),
            'remarks'    => 'Payment confirmed.',
        ]);

        return redirect()->route('orders.show', $order)
            ->with('success', 'Payment successful! Your order is being processed.');
    }
}
