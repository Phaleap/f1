<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderCoupon;
use App\Models\UserAddress;
use App\Models\ShippingMethod;
use App\Models\User;
use App\Models\OrderStatusHistory;
use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class CheckoutController extends Controller
{
    private function authUser(): User
{
    return Auth::user();
}

    public function index()
    {
        $user  = $this->authUser();
        $cart  = $user->cart;
        $items = $cart ? $cart->items()->with(['product.mainImage', 'variant'])->get() : collect();

        if ($items->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        $subtotal        = $items->sum(fn($i) => $i->unit_price * $i->quantity);
        $addresses       = $user->addresses()->get();
        $shippingMethods = ShippingMethod::where('status', 'active')->get();
        $coupon          = session('coupon');

        return view('checkout.index', compact(
            'items', 'subtotal', 'addresses', 'shippingMethods', 'coupon'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'address_id'         => 'required|exists:user_addresses,address_id',
            'shipping_method_id' => 'required|exists:shipping_methods,shipping_method_id',
        ]);

        $user  = $this->authUser();
        $cart  = $user->cart;
        $items = $cart->items()->with(['product', 'variant'])->get();

        if ($items->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        $shippingMethod = ShippingMethod::find($request->shipping_method_id);
        $subtotal       = $items->sum(fn($i) => $i->unit_price * $i->quantity);
        $shippingFee    = $shippingMethod->fee;

        // Coupon from session
        $couponSession    = session('coupon');
        $discountAmount   = $couponSession ? $couponSession['discount'] : 0;
        $totalAmount      = $subtotal + $shippingFee - $discountAmount;

        DB::transaction(function () use (
            $user, $cart, $items, $request,
            $subtotal, $shippingFee, $discountAmount,
            $totalAmount, $couponSession
        ) {
            // Create order
            $order = Order::create([
                'user_id'            => $user->id,
                'address_id'         => $request->address_id,
                'shipping_method_id' => $request->shipping_method_id,
                'subtotal'           => $subtotal,
                'discount_amount'    => $discountAmount,
                'shipping_fee'       => $shippingFee,
                'total_amount'       => $totalAmount,
                'order_status'       => 'pending',
                'order_date'         => now(),
                'notes'              => $request->notes,
            ]);

            // Create order items
            foreach ($items as $item) {
                OrderItem::create([
                    'order_id'        => $order->id,
                    'product_id'      => $item->product_id,
                    'variant_id'      => $item->variant_id,
                    'quantity'        => $item->quantity,
                    'unit_price'      => $item->unit_price,
                    'discount_amount' => 0,
                    'subtotal'        => $item->unit_price * $item->quantity,
                ]);
            }

            // Attach coupon if used
            if ($couponSession) {
                OrderCoupon::create([
                    'order_id'        => $order->id,
                    'coupon_id'       => $couponSession['id'],
                    'discount_amount' => $couponSession['discount'],
                ]);

                // Increment used count
                Coupon::where('coupon_id', $couponSession['id'])
                    ->increment('used_count');

                session()->forget('coupon');
            }

            // Log initial status
            OrderStatusHistory::create([
                'order_id'   => $order->id,
                'status'     => 'pending',
                'changed_by' => $user->id,
                'changed_at' => now(),
                'remarks'    => 'Order placed.',
            ]);

            // Clear cart
            $cart->items()->delete();
            $cart->delete();

            // Store order id for redirect
            session(['last_order_id' => $order->id]);
        });

        $orderId = session('last_order_id');

        return redirect()->route('payment.show', $orderId)
            ->with('success', 'Order placed! Complete your payment.');
    }
}
