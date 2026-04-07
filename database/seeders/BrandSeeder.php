<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Brand;

class BrandSeeder extends Seeder
{
    public function run(): void
    {
        Brand::insert([
            ['brand_name' => 'Ferrari',          'country' => 'Italy',       'created_at' => now()],
            ['brand_name' => 'Mercedes-AMG',     'country' => 'Germany',     'created_at' => now()],
            ['brand_name' => 'Red Bull Racing',  'country' => 'Austria',     'created_at' => now()],
            ['brand_name' => 'McLaren',          'country' => 'UK',          'created_at' => now()],
            ['brand_name' => 'Aston Martin',     'country' => 'UK',          'created_at' => now()],
        ]);
    }
}
