<?php

namespace database\seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Handbags', 'Backpacks', 'Crossbody Bags', 'Wallets', 'Totes',
            'Clutches', 'Messenger Bags', 'Duffel Bags', 'Shoulder Bags', 'Satchels',
            'Briefcases', 'Hobo Bags', 'Bucket Bags', 'Belt Bags', 'Laptop Bags'
        ];

        foreach ($categories as $name) {
            $category = Category::create([
                'name' => $name,
                'slug' => Str::slug($name),
                'status' => 'active',
                'image' => null
            ]);

            // Randomly assign some products to this category
            $products = Product::inRandomOrder()->take(rand(3, 8))->pluck('id');
            $category->products()->attach($products);
        }
    }
}
