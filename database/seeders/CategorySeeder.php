<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        // Parent categories
        $cars = Category::create(['category_name' => 'F1 Cars', 'description' => 'Formula 1 car models']);
        $merch = Category::create(['category_name' => 'Merchandise', 'description' => 'F1 merchandise']);

        // Sub categories
        Category::insert([
            ['category_name' => 'Scale Models',  'description' => '1:18 and 1:43 scale models', 'parent_category_id' => $cars->id],
            ['category_name' => 'Full Size Cars', 'description' => 'Full size F1 cars',          'parent_category_id' => $cars->id],
            ['category_name' => 'T-Shirts',       'description' => 'F1 team t-shirts',           'parent_category_id' => $merch->id],
            ['category_name' => 'Caps & Hats',    'description' => 'F1 team caps and hats',      'parent_category_id' => $merch->id],
            ['category_name' => 'Jackets',        'description' => 'F1 team jackets',            'parent_category_id' => $merch->id],
        ]);
    }
}
