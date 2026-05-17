<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ShopController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, "index"])->name("home");
Route::get("/shop", [ShopController::class, "index"])->name("home.shop");
Route::get("/product/{product:slug}", [ProductController::class, "index"])->name("home.products");
Route::get("/checkout", [CheckoutController::class, "index"])->name("home.checkout");
Route::post("/checkout", [CheckoutController::class, "store"])->name("home.checkout.store");
Route::get("/order-success", [CheckoutController::class, "success"])->name("home.order-success");
Route::get("/cart", [CartController::class, "index"])->name("home.cart");

