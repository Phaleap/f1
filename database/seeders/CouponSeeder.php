<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Coupon;

class CouponSeeder extends Seeder
{
    public function run(): void
    {
        Coupon::insert([
            [
                'code'             => 'F1LAUNCH',
                'description'      => '10% off your first order',
                'discount_type'    => 'percentage',
                'discount_value'   => 10.00,
                'min_order_amount' => 50.00,
                'usage_limit'      => 100,
                'used_count'       => 0,
                'start_date'       => now(),
                'end_date'         => now()->addYear(),
                'status'           => 'active',
                'created_at'       => now(),
            ],
            [
                'code'             => 'FLAT20',
                'description'      => '$20 off orders over $200',
                'discount_type'    => 'fixed',
                'discount_value'   => 20.00,
                'min_order_amount' => 200.00,
                'usage_limit'      => 50,
                'used_count'       => 0,
                'start_date'       => now(),
                'end_date'         => now()->addMonths(6),
                'status'           => 'active',
                'created_at'       => now(),
            ],
        ]);
    }
}
