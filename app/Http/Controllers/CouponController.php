<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function apply(Request $request)
    {
        $request->validate([
            'code'        => 'required|string',
            'cart_total'  => 'required|numeric',
        ]);

        $coupon = Coupon::where('code', $request->code)
            ->where('status', 'active')
            ->where('start_date', '<=', now())
            ->where('end_date', '>=', now())
            ->first();

        if (!$coupon) {
            return response()->json(['error' => 'Invalid or expired coupon.'], 422);
        }

        // Check usage limit
        if ($coupon->usage_limit && $coupon->used_count >= $coupon->usage_limit) {
            return response()->json(['error' => 'Coupon usage limit reached.'], 422);
        }

        // Check minimum order amount
        if ($request->cart_total < $coupon->min_order_amount) {
            return response()->json([
                'error' => "Minimum order amount is $" . number_format($coupon->min_order_amount, 2)
            ], 422);
        }

        // Calculate discount
        $discount = $coupon->discount_type === 'percentage'
            ? ($request->cart_total * $coupon->discount_value / 100)
            : $coupon->discount_value;

        $discount = min($discount, $request->cart_total);

        // Store coupon in session
        session(['coupon' => [
            'id'       => $coupon->coupon_id,
            'code'     => $coupon->code,
            'discount' => round($discount, 2),
        ]]);

        return response()->json([
            'success'  => 'Coupon applied.',
            'discount' => round($discount, 2),
            'code'     => $coupon->code,
        ]);
    }

    public function remove()
    {
        session()->forget('coupon');
        return back()->with('success', 'Coupon removed.');
    }
}
