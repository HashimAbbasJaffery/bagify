<?php

namespace App\View\Components\Sections\Products;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Product;

class Listing1 extends Component
{
    public $products;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $limit = 8;
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

        $this->products = $products;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.sections.products.listing-1');
    }
}
