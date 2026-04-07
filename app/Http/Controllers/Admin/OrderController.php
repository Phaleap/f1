<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Shipment;
use App\Models\OrderStatusHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::with(['user', 'payment', 'shipment'])->latest();

        if ($request->filled('status')) {
            $query->where('order_status', $request->status);
        }

        if ($request->filled('search')) {
            $query->whereHas('user', fn($q) =>
                $q->where('full_name', 'like', '%' . $request->search . '%')
            );
        }

        $orders = $query->paginate(20)->withQueryString();

        return view('admin.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        $order->load([
            'user', 'address', 'items.product', 'items.variant',
            'payment.paymentMethod', 'shipment', 'statusHistory.changedBy',
            'shippingMethod', 'coupons'
        ]);

        return view('admin.orders.show', compact('order'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status'  => 'required|in:pending,processing,shipped,delivered,cancelled',
            'remarks' => 'nullable|string',
        ]);

        $order->update(['order_status' => $request->status]);

        OrderStatusHistory::create([
            'order_id'   => $order->id,
            'status'     => $request->status,
            'changed_by' => Auth::id(),
            'changed_at' => now(),
            'remarks'    => $request->remarks,
        ]);

        return back()->with('success', 'Order status updated.');
    }

    public function addShipment(Request $request, Order $order)
    {
        $request->validate([
            'tracking_number' => 'required|string',
            'courier_name'    => 'required|string',
            'shipping_cost'   => 'nullable|numeric',
        ]);

        Shipment::updateOrCreate(
            ['order_id' => $order->id],
            [
                'tracking_number'  => $request->tracking_number,
                'courier_name'     => $request->courier_name,
                'shipped_date'     => now(),
                'shipment_status'  => 'shipped',
                'shipping_cost'    => $request->shipping_cost,
            ]
        );

        $order->update(['order_status' => 'shipped']);

        OrderStatusHistory::create([
            'order_id'   => $order->id,
            'status'     => 'shipped',
            'changed_by' => Auth::id(),
            'changed_at' => now(),
            'remarks'    => 'Shipment added. Tracking: ' . $request->tracking_number,
        ]);

        return back()->with('success', 'Shipment info added.');
    }
}
