<?php

use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\ColorController;
use App\Http\Controllers\Api\SizeController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\CheckoutController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get("products", [ProductController::class, "get"])->name("product.get");
Route::get("products/related", [ProductController::class, "related"])->name("product.related");
Route::get("products/recommended", [ProductController::class, "recommended"])->name("product.recommended");
Route::get("products/best-deals", [ProductController::class, "bestDeals"])->name("product.best-deals");
Route::get("products/search", [ProductController::class, "search"])->name("product.search");
Route::get("products/{product:slug}", [ProductController::class, "show"])->name("product.show");
Route::get("colors", [ColorController::class, "get"])->name("color.get");
Route::get("sizes", [SizeController::class, "get"])->name("size.get");
Route::get("categories", [CategoryController::class, "get"])->name("category.get");

// Cart API Endpoints (wrapped with session state middleware)
Route::middleware('web')->group(function () {
    Route::get("cart", [CartController::class, "get"])->name("cart.get");
    Route::post("cart", [CartController::class, "add"])->name("cart.add");
    Route::put("cart/{key}", [CartController::class, "update"])->name("cart.update");
    Route::delete("cart/{key}", [CartController::class, "remove"])->name("cart.remove");
    Route::delete("cart", [CartController::class, "clear"])->name("cart.clear");
});

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
