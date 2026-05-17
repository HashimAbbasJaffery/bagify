<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Product $product)
    {
        $product->load(['colors', 'sizes', 'media', 'categories']);

        // Fetch up to 4 related products from the same categories, excluding current product
        $relatedProducts = Product::where('id', '!=', $product->id)
            ->whereHas('categories', function ($q) use ($product) {
                $q->whereIn('categories.id', $product->categories->pluck('id'));
            })
            ->with(['media'])
            ->inRandomOrder()
            ->limit(4)
            ->get();

        // Fallback to random products if category matching products are less than 4
        if ($relatedProducts->count() < 4) {
            $extraProducts = Product::where('id', '!=', $product->id)
                ->whereNotIn('id', $relatedProducts->pluck('id'))
                ->with(['media'])
                ->inRandomOrder()
                ->limit(4 - $relatedProducts->count())
                ->get();
            $relatedProducts = $relatedProducts->concat($extraProducts);
        }

        return view("products", compact('product', 'relatedProducts'));
    }
}

