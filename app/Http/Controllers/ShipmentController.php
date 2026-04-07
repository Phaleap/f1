<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class ShipmentController extends Controller
{

    public function track(Order $order)
    {
        if ($order->user_id !== Auth::id()) abort(403);

        $shipment = $order->shipment;
        $history  = $order->statusHistory()->orderBy('changed_at', 'desc')->get();

        return view('shipment.track', compact('order', 'shipment', 'history'));
    }
}
