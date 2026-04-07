<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    private function authUser(): \App\Models\User
    {
        return Auth::user();
    }

    public function index()
    {
        $orders = $this->authUser()->orders()->latest()->get();
        return view('orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        if ($order->user_id !== $this->authUser()->id) {
            abort(403);
        }

        $items = $order->items()->with('product')->get();
        return view('orders.show', compact('order', 'items'));
    }
}
