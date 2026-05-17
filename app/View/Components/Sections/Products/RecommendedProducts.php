<?php

namespace App\View\Components\Sections\Products;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Product;

class RecommendedProducts extends Component
{
    public $products;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->products = Product::with(['colors', 'sizes', 'media', 'categories'])
            ->where('status', 'active')
            ->inRandomOrder()
            ->take(4)
            ->get();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.sections.products.recommended-products');
    }
}
