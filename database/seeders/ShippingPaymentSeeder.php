<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ShippingMethod;
use App\Models\PaymentMethod;

class ShippingPaymentSeeder extends Seeder
{
    public function run(): void
    {
        ShippingMethod::insert([
            ['method_name' => 'Standard Shipping', 'fee' => 9.99,  'estimated_days' => 7,  'status' => 'active'],
            ['method_name' => 'Express Shipping',  'fee' => 24.99, 'estimated_days' => 3,  'status' => 'active'],
            ['method_name' => 'Overnight Shipping','fee' => 49.99, 'estimated_days' => 1,  'status' => 'active'],
            ['method_name' => 'Free Shipping',     'fee' => 0.00,  'estimated_days' => 14, 'status' => 'active'],
        ]);

        PaymentMethod::insert([
            ['method_name' => 'Credit Card',  'provider' => 'Stripe',  'status' => 'active'],
            ['method_name' => 'PayPal',       'provider' => 'PayPal',  'status' => 'active'],
            ['method_name' => 'Bank Transfer','provider' => 'Manual',  'status' => 'active'],
        ]);
    }
}
