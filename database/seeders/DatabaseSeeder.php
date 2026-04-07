<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            CategorySeeder::class,
            BrandSeeder::class,
            TeamDriverSeeder::class,
            ProductSeeder::class,
            ShippingPaymentSeeder::class,
            CouponSeeder::class,
        ]);
    }
}
