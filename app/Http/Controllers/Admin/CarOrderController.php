<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CarOrder;
use App\Models\CarOrderStatusHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CarOrderController extends Controller
{
    // List all car orders
    public function index()
    {
        $orders = CarOrder::with(['user', 'request.product'])
            ->latest()
            ->paginate(20);

        return view('admin.car-orders.index', compact('orders'));
    }

    // Show single car order detail
    public function show($id)
    {
        $order = CarOrder::with([
            'user', 'request.product',
            'statusHistory.changedBy', 'address'
        ])->findOrFail($id);

        return view('admin.car-orders.show', compact('order'));
    }

    // Confirm walk-in payment manually
    public function confirmWalkInPayment(Request $request, $id)
    {
        $request->validate([
            'payment_notes' => 'nullable|string|max:500'
        ]);

        $order = CarOrder::findOrFail($id);

        // Guard: only walk-in orders can use this
        if ($order->payment_preference !== 'walk_in') {
            return back()->with('error', 'This order is not a walk-in payment.');
        }

        $order->update([
            'car_order_status'     => 'paid',
            'payment_confirmed_by' => Auth::id(),
            'payment_confirmed_at' => now(),
            'payment_notes'        => $request->payment_notes ?? 'Paid in showroom',
        ]);

        CarOrderStatusHistory::create([
            'car_order_id' => $order->car_order_id,
            'status'       => 'paid',
            'changed_by'   => Auth::id(),
            'changed_at'   => now(),
            'remarks'      => 'Walk-in payment confirmed by admin.',
        ]);

        return redirect()->route('admin.car-orders.show', $id)
            ->with('success', 'Walk-in payment confirmed.');
    }

    // Update order status
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status'  => 'required|in:confirmed,paid,in_preparation,ready,delivered,cancelled',
            'remarks' => 'nullable|string|max:500',
        ]);

        $order = CarOrder::findOrFail($id);
        $order->update(['car_order_status' => $request->status]);

        CarOrderStatusHistory::create([
            'car_order_id' => $order->car_order_id,
            'status'       => $request->status,
            'changed_by'   => Auth::id(),
            'changed_at'   => now(),
            'remarks'      => $request->remarks ?? 'Status updated by admin.',
        ]);

        return redirect()->route('admin.car-orders.show', $id)
            ->with('success', 'Order status updated to ' . $request->status . '.');
    }
}