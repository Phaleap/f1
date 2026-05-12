<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CarPurchaseRequest;
use App\Models\CarOrder;
use App\Models\CarOrderStatusHistory;
use App\Models\Inventory;
use App\Models\StockMovement;
use App\Services\TelegramService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CarRequestController extends Controller
{
    public function index()
    {
        $requests = CarPurchaseRequest::with(['user', 'product'])
            ->latest()
            ->paginate(20);

        return view('admin.car-requests.index', compact('requests'));
    }

    public function show($id)
    {
        $carRequest = CarPurchaseRequest::with([
            'user', 'product', 'appointment', 'carOrder'
        ])->findOrFail($id);

        return view('admin.car-requests.show', compact('carRequest'));
    }

    public function approve($id)
    {
        $carRequest = CarPurchaseRequest::with(['user', 'product'])->findOrFail($id);

        if ($carRequest->request_status !== 'pending') {
            return back()->with('error', 'This request has already been reviewed.');
        }

        $carRequest->update([
            'request_status' => 'approved',
            'reviewed_by'    => Auth::id(),
            'reviewed_at'    => now(),
        ]);

        $carOrder = CarOrder::create([
            'request_id'         => $carRequest->request_id,
            'user_id'            => $carRequest->user_id,
            'final_price'        => $carRequest->product->base_price,
            'car_order_status'   => 'confirmed',
            'payment_preference' => $carRequest->payment_preference,
        ]);

        CarOrderStatusHistory::create([
            'car_order_id' => $carOrder->car_order_id,
            'status'       => 'confirmed',
            'changed_by'   => Auth::id(),
            'changed_at'   => now(),
            'remarks'      => 'Request approved, car order created.',
        ]);

        // Decrement stock
        $inventory = Inventory::where('product_id', $carRequest->product_id)
            ->whereNull('variant_id')
            ->first();

        if ($inventory) {
            $inventory->decrement('stock_quantity', 1);
            $inventory->update(['last_updated' => now()]);

            StockMovement::create([
                'inventory_id'  => $inventory->inventory_id,
                'movement_type' => 'out',
                'quantity'      => 1,
                'reason'        => 'Car purchase request approved. Order #' . $carOrder->car_order_id,
                'moved_by'      => Auth::id(),
                'moved_at'      => now(),
            ]);
        }

        // Notify admin
        try {
            $telegram = new TelegramService();
            $telegram->notifyAdmin(
                "✅ <b>Car Request Approved</b>\n\n" .
                "👤 Customer: {$carRequest->full_name}\n" .
                "🚗 Car: {$carRequest->product->product_name}\n" .
                "💳 Payment: " . ucfirst(str_replace('_', ' ', $carRequest->payment_preference)) . "\n" .
                "📦 Car Order: #{$carOrder->car_order_id}\n\n" .
                "👉 View order: " . url('/admin/car-orders/' . $carOrder->car_order_id)
            );
        } catch (\Exception $e) {
            // Silently fail
        }

        return redirect()->route('admin.car-requests.index')
            ->with('success', 'Request approved and car order #' . $carOrder->car_order_id . ' created.');
    }

    public function reject(Request $request, $id)
    {
        $request->validate([
            'rejection_reason' => 'required|string|max:500'
        ]);

        $carRequest = CarPurchaseRequest::with(['user', 'product'])->findOrFail($id);

        if ($carRequest->request_status !== 'pending') {
            return back()->with('error', 'This request has already been reviewed.');
        }

        $carRequest->update([
            'request_status'   => 'rejected',
            'reviewed_by'      => Auth::id(),
            'reviewed_at'      => now(),
            'rejection_reason' => $request->rejection_reason,
        ]);

        try {
            $telegram = new TelegramService();
            $telegram->notifyAdmin(
                "❌ <b>Car Request Rejected</b>\n\n" .
                "👤 Customer: {$carRequest->full_name}\n" .
                "🚗 Car: {$carRequest->product->product_name}\n" .
                "📋 Request ID: #{$carRequest->request_id}\n" .
                "💬 Reason: {$request->rejection_reason}"
            );
        } catch (\Exception $e) {
            // Silently fail
        }

        return redirect()->route('admin.car-requests.index')
            ->with('success', 'Request rejected.');
    }

    public function confirmAppointment($id)
    {
        $carRequest = CarPurchaseRequest::with(['appointment', 'product'])->findOrFail($id);

        if ($carRequest->appointment) {
            $carRequest->appointment->update([
                'appointment_status' => 'confirmed',
                'confirmed_by'       => Auth::id(),
                'confirmed_at'       => now(),
            ]);

            try {
                $telegram = new TelegramService();
                $appt = $carRequest->appointment;
                $telegram->notifyAdmin(
                    "📅 <b>Appointment Confirmed</b>\n\n" .
                    "👤 Customer: {$carRequest->full_name}\n" .
                    "🚗 Car: {$carRequest->product->product_name}\n" .
                    "📆 Date: " . \Carbon\Carbon::parse($appt->appointment_date)->format('d M Y, H:i') . "\n" .
                    "📍 Location: " . ($appt->location ?? 'TBD')
                );
            } catch (\Exception $e) {
                // Silently fail
            }
        }

        return redirect()->route('admin.car-requests.show', $id)
            ->with('success', 'Appointment confirmed.');
    }
}