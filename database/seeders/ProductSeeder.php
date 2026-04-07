<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\Inventory;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // --- F1 Cars ---
        $car1 = Product::create([
            'category_id'  => 3, // Scale Models
            'brand_id'     => 1, // Ferrari
            'car_model_id' => 1, // Ferrari SF-24
            'product_name' => 'Ferrari SF-24 Scale Model 1:18',
            'sku'          => 'CAR-FER-SF24-118',
            'description'  => 'Official Ferrari SF-24 2024 season scale model 1:18.',
            'base_price'   => 299.99,
            'cost_price'   => 120.00,
            'product_type' => 'car',
            'weight'       => 1.20,
            'status'       => 'active',
            'created_at'   => now(),
            'updated_at'   => now(),
        ]);

        $car2 = Product::create([
            'category_id'  => 3,
            'brand_id'     => 3, // Red Bull
            'car_model_id' => 3, // RB20
            'product_name' => 'Red Bull RB20 Scale Model 1:18',
            'sku'          => 'CAR-RB-RB20-118',
            'description'  => 'Official Red Bull Racing RB20 2024 season scale model 1:18.',
            'base_price'   => 319.99,
            'cost_price'   => 130.00,
            'product_type' => 'car',
            'weight'       => 1.20,
            'status'       => 'active',
            'created_at'   => now(),
            'updated_at'   => now(),
        ]);

        // --- Merchandise ---
        $shirt1 = Product::create([
            'category_id'  => 5, // T-Shirts
            'brand_id'     => 1, // Ferrari
            'product_name' => 'Ferrari Team T-Shirt 2024',
            'sku'          => 'MERCH-FER-TSHIRT-2024',
            'description'  => 'Official Ferrari F1 team t-shirt for the 2024 season.',
            'base_price'   => 59.99,
            'cost_price'   => 20.00,
            'product_type' => 'merchandise',
            'material'     => '100% Cotton',
            'weight'       => 0.25,
            'status'       => 'active',
            'created_at'   => now(),
            'updated_at'   => now(),
        ]);

        $cap1 = Product::create([
            'category_id'  => 6, // Caps & Hats
            'brand_id'     => 3, // Red Bull
            'product_name' => 'Red Bull Racing Cap 2024',
            'sku'          => 'MERCH-RB-CAP-2024',
            'description'  => 'Official Red Bull Racing team cap for the 2024 season.',
            'base_price'   => 39.99,
            'cost_price'   => 12.00,
            'product_type' => 'merchandise',
            'material'     => 'Polyester',
            'weight'       => 0.15,
            'status'       => 'active',
            'created_at'   => now(),
            'updated_at'   => now(),
        ]);

        // Inventory for cars (no variants)
        Inventory::insert([
            [
                'product_id'     => $car1->id,
                'stock_quantity' => 15,
                'minimum_stock'  => 3,
                'last_updated'   => now(),
            ],
            [
                'product_id'     => $car2->id,
                'stock_quantity' => 10,
                'minimum_stock'  => 3,
                'last_updated'   => now(),
            ],
        ]);

        // Variants + inventory for shirt
        foreach (['S', 'M', 'L', 'XL', 'XXL'] as $size) {
            $variant = ProductVariant::create([
                'product_id'   => $shirt1->id,
                'variant_name' => "Size $size",
                'size'         => $size,
                'color'        => 'Red',
                'extra_price'  => $size === 'XXL' ? 5.00 : 0,
                'sku'          => "MERCH-FER-TSHIRT-2024-$size",
                'status'       => 'active',
                'created_at'   => now(),
            ]);

            Inventory::create([
                'product_id'     => $shirt1->id,
                'variant_id'     => $variant->variant_id,
                'stock_quantity' => rand(10, 50),
                'minimum_stock'  => 5,
                'last_updated'   => now(),
            ]);
        }

        // Variants + inventory for cap
        foreach (['S/M', 'L/XL'] as $size) {
            $variant = ProductVariant::create([
                'product_id'   => $cap1->id,
                'variant_name' => "Size $size",
                'size'         => $size,
                'color'        => 'Blue/Red',
                'extra_price'  => 0,
                'sku'          => 'MERCH-RB-CAP-2024-' . str_replace('/', '', $size),
                'status'       => 'active',
                'created_at'   => now(),
            ]);

            Inventory::create([
                'product_id'     => $cap1->id,
                'variant_id'     => $variant->variant_id,
                'stock_quantity' => rand(20, 60),
                'minimum_stock'  => 5,
                'last_updated'   => now(),
            ]);
        }
    }
}
