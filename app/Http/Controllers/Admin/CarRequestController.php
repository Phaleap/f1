<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CarPurchaseRequest;
use App\Models\CarOrder;
use App\Models\CarOrderStatusHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CarRequestController extends Controller
{
    // List all requests
    public function index()
    {
        $requests = CarPurchaseRequest::with(['user', 'product'])
            ->latest()
            ->paginate(20);

        return view('admin.car-requests.index', compact('requests'));
    }

    // Show single request detail
    public function show($id)
    {
        $carRequest = CarPurchaseRequest::with([
            'user', 'product', 'appointment', 'carOrder'
        ])->findOrFail($id);

        return view('admin.car-requests.show', compact('carRequest'));
    }

    // Approve → creates car_order automatically
    public function approve($id)
    {
        $carRequest = CarPurchaseRequest::findOrFail($id);

        // Guard: only pending requests can be approved
        if ($carRequest->request_status !== 'pending') {
            return back()->with('error', 'This request has already been reviewed.');
        }

        $carRequest->update([
            'request_status' => 'approved',
            'reviewed_by'    => Auth::id(),
            'reviewed_at'    => now(),
        ]);

        // Create car order right after approval
        $carOrder = CarOrder::create([
            'request_id'         => $carRequest->request_id,
            'user_id'            => $carRequest->user_id,
            'final_price'        => $carRequest->product->base_price,
            'car_order_status'   => 'confirmed',
            'payment_preference' => $carRequest->payment_preference,
        ]);

        // Log first status history
        CarOrderStatusHistory::create([
            'car_order_id' => $carOrder->car_order_id,
            'status'       => 'confirmed',
            'changed_by'   => Auth::id(),
            'changed_at'   => now(),
            'remarks'      => 'Request approved, car order created.',
        ]);

        return redirect()->route('admin.car-requests.index')
            ->with('success', 'Request approved and car order #' . $carOrder->car_order_id . ' created.');
    }

    // Reject request
    public function reject(Request $request, $id)
    {
        $request->validate([
            'rejection_reason' => 'required|string|max:500'
        ]);

        $carRequest = CarPurchaseRequest::findOrFail($id);

        // Guard: only pending requests can be rejected
        if ($carRequest->request_status !== 'pending') {
            return back()->with('error', 'This request has already been reviewed.');
        }

        $carRequest->update([
            'request_status'   => 'rejected',
            'reviewed_by'      => Auth::id(),
            'reviewed_at'      => now(),
            'rejection_reason' => $request->rejection_reason,
        ]);

        return redirect()->route('admin.car-requests.index')
            ->with('success', 'Request rejected.');
    }
}