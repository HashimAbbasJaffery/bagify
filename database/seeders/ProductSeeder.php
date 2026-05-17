<?php

namespace Database\Seeders;

use App\Models\Color;
use App\Models\Product;
use App\Models\Size;
use App\Models\Media;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $colors = Color::all();
        $sizes = Size::all();

        // High-quality bag images from Unsplash
        $bagImages = [
            'https://images.unsplash.com/photo-1584917865442-de89df76afd3?q=80&w=1000&auto=format&fit=crop',
            'https://images.unsplash.com/photo-1590874103328-eac38a683ce7?q=80&w=1000&auto=format&fit=crop',
            'https://images.unsplash.com/photo-1548036328-c9fa89d128fa?q=80&w=1000&auto=format&fit=crop',
            'https://images.unsplash.com/photo-1622560480605-d83c853bc5c3?q=80&w=1000&auto=format&fit=crop',
            'https://images.unsplash.com/photo-1591561954557-26941169b49e?q=80&w=1000&auto=format&fit=crop',
            'https://images.unsplash.com/photo-1566150905458-1bf1fd113961?q=80&w=1000&auto=format&fit=crop',
            'https://images.unsplash.com/photo-1598532163257-ae3c6b2524b6?q=80&w=1000&auto=format&fit=crop',
            'https://images.unsplash.com/photo-1605733513597-a8f8341084e6?q=80&w=1000&auto=format&fit=crop',
            'https://images.unsplash.com/photo-1575032617751-6ddec2089882?q=80&w=1000&auto=format&fit=crop',
            'https://images.unsplash.com/photo-1594223274512-ad4803739b7c?q=80&w=1000&auto=format&fit=crop',
        ];

        for ($i = 1; $i <= 30; $i++) {
            $product = Product::create([
                'name' => "Bagify Elite Series Vol. $i",
                'short_description' => "Premium handcrafted luxury bag from our elite collection. Model $i.",
                'sku' => "BAG-" . strtoupper(Str::random(8)),
                'stock' => rand(0, 10) > 2 ? 'instock' : 'outofstock',
                'price' => rand(1500, 5000),
                'discount_percentage' => rand(5, 15),
                'quantity' => rand(10, 50),
                'status' => 'active',
                'is_featured' => rand(1, 5) === 1,
                'description' => "Experience the pinnacle of craftsmanship with the Bagify Elite Series. Each piece is meticulously designed using premium materials to ensure timeless elegance and unparalleled durability. Perfect for any occasion, from corporate meetings to casual outings.",
            ]);

            // Add polymorphic media using high-quality Unsplash images
            $randomImages = collect($bagImages)->random(3)->values();
            foreach ($randomImages as $imageUrl) {
                Media::create([
                    'url' => $imageUrl,
                    'mediable_id' => $product->id,
                    'mediable_type' => Product::class,
                ]);
            }

            // Attach 1 to 5 random colors
            $product->colors()->attach(
                $colors->random(rand(1, min(5, $colors->count())))->pluck('id')->toArray()
            );

            // Attach random sizes
            $product->sizes()->attach(
                $sizes->random(rand(1, $sizes->count()))->pluck('id')->toArray()
            );
        }
    }
}
