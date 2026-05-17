<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Resources\CategoryResource;

class CategoryController extends Controller
{
    public function get()
    {
        // We include products_count to show the number next to the category in the filter
        $categories = Category::withCount('products')->where('status', 'active')->get();
        return CategoryResource::collection($categories);
    }
}
