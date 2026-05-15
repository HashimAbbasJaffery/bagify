<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ShopController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, "index"])->name("home");
Route::get("/shop", [ShopController::class, "index"])->name("home.shop");
Route::get("single-product", [ProductController::class, "index"])->name("home.products");
Route::get("/checkout", [CheckoutController::class, "index"])->name("home.checkout");
Route::get("/cart", [CartController::class, "index"])->name("home.cart");
