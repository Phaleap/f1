<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function apply(Request $request)
{
    $request->validate(['coupon_code' => 'required|string']);

    $coupon = Coupon::where('code', strtoupper($request->coupon_code))
                   ->where('status', 'active')
                   ->first();

    if (!$coupon) {
        return back()->with('coupon_error', 'Invalid coupon code.');
    }

    if ($coupon->end_date && now()->gt($coupon->end_date)) {
        return back()->with('coupon_error', 'This coupon has expired.');
    }

    if ($coupon->usage_limit && $coupon->used_count >= $coupon->usage_limit) {
        return back()->with('coupon_error', 'This coupon has reached its usage limit.');
    }

    // Calculate discount
    $subtotal = Auth::user()->cart->items->sum(fn($i) => $i->unit_price * $i->quantity);

    if ($subtotal < $coupon->min_order_amount) {
        return back()->with('coupon_error', 
            'Minimum order of $' . number_format($coupon->min_order_amount, 2) . ' required.');
    }

    $discount = $coupon->discount_type === 'percentage'
        ? $subtotal * ($coupon->discount_value / 100)
        : $coupon->discount_value;

    session(['coupon' => [
        'id'       => $coupon->coupon_id,
        'code'     => $coupon->code,
        'discount' => round($discount, 2),
    ]]);

    return back();
}

    public function remove()
    {
        session()->forget('coupon');
        return back()->with('success', 'Coupon removed.');
    }
    
}
