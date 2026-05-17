<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Resources\ProductResource;


class ProductController extends Controller
{
    public function get(Request $request) {
        $products = Product::filter($request->all())->paginate(12);

        return ProductResource::collection($products);
    }

    public function show(Product $product) {
        $product->load(['colors', 'sizes', 'media', 'categories']);
        return new ProductResource($product);
    }

    public function related(Request $request) {
        $cart = session()->get('cart', []);
        $productIdsInCart = array_column($cart, 'product_id');

        $query = Product::with(['colors', 'sizes', 'media', 'categories']);

        if (!empty($productIdsInCart)) {
            // Fetch category IDs of items in the cart
            $categoryIds = \DB::table('product_category')
                ->whereIn('product_id', $productIdsInCart)
                ->pluck('category_id')
                ->toArray();

            if (!empty($categoryIds)) {
                $query->whereHas('categories', function($q) use ($categoryIds) {
                    $q->whereIn('categories.id', $categoryIds);
                })->whereNotIn('id', $productIdsInCart);
            }
        }

        $products = $query->inRandomOrder()->take(4)->get();

        // Fallback fill to 4 suggestions if needed
        if ($products->count() < 4) {
            $remaining = 4 - $products->count();
            $excludeIds = array_merge($productIdsInCart, $products->pluck('id')->toArray());
            $additionalProducts = Product::with(['colors', 'sizes', 'media', 'categories'])
                ->whereNotIn('id', $excludeIds)
                ->inRandomOrder()
                ->take($remaining)
                ->get();
            $products = $products->concat($additionalProducts);
        }

        return ProductResource::collection($products);
    }

    public function recommended(Request $request) {
        $products = Product::with(['colors', 'sizes', 'media', 'categories'])
            ->inRandomOrder()
            ->take(4)
            ->get();

        return ProductResource::collection($products);
    }

    public function bestDeals(Request $request) {
        $limit = $request->get('limit', 8);
        $products = Product::with(['colors', 'sizes', 'media', 'categories'])
            ->where('status', 'active')
            ->where('discount_percentage', '>', 0)
            ->orderByDesc('discount_percentage')
            ->take($limit)
            ->get();

        if ($products->count() < $limit) {
            $remaining = $limit - $products->count();
            $excludeIds = $products->pluck('id')->toArray();
            $additionalProducts = Product::with(['colors', 'sizes', 'media', 'categories'])
                ->where('status', 'active')
                ->whereNotIn('id', $excludeIds)
                ->inRandomOrder()
                ->take($remaining)
                ->get();
            $products = $products->concat($additionalProducts);
        }

        return ProductResource::collection($products);
    }

    public function search(Request $request) {
        $queryText = $request->query('query', '');

        if (empty($queryText)) {
            return ProductResource::collection(collect());
        }

        $products = Product::with(['colors', 'sizes', 'media', 'categories'])
            ->where('status', 'active')
            ->where(function($q) use ($queryText) {
                $q->where('name', 'like', "%{$queryText}%")
                  ->orWhere('short_description', 'like', "%{$queryText}%")
                  ->orWhere('description', 'like', "%{$queryText}%");
            })
            ->take(10)
            ->get();

        return ProductResource::collection($products);
    }
}

