<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class CategoryProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Сначала создаём категории
        $categories = Category::factory(10)->create();

        // Затем создаём продукты и привязываем их к существующим категориям
        Product::factory(100)->create([
            'category_id' => fn () => $categories->random()->id,
        ]);
    }
}
