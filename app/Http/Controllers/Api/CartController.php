<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    /**
     * Retrieve the current cart state.
     */
    public function get()
    {
        return response()->json([
            'success' => true,
            'cart' => $this->getCartSummary()
        ]);
    }

    /**
     * Add a product variant to the cart.
     */
    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'color' => 'nullable|string',
            'size' => 'nullable|string',
        ]);

        $product = Product::findOrFail($request->product_id);

        // Enforce inventory stock check
        if ($product->stock !== 'instock' || $product->quantity < $request->quantity) {
            return response()->json([
                'success' => false,
                'message' => 'Requested quantity is not available in stock.'
            ], 422);
        }

        $cart = session()->get('cart', []);
        
        // Key represents the unique combination of product id, selected color, and size
        $key = $product->id . '-' . strtolower($request->color ?? 'none') . '-' . strtolower($request->size ?? 'none');

        // Dynamic price calculation with discount percentage
        $price = $product->price;
        if ($product->discount_percentage > 0) {
            $price = $product->price - ($product->price * ($product->discount_percentage / 100));
        }

        if (isset($cart[$key])) {
            $newQuantity = $cart[$key]['quantity'] + $request->quantity;
            
            // Check inventory capacity for cumulative quantity
            if ($product->quantity < $newQuantity) {
                return response()->json([
                    'success' => false,
                    'message' => "Only {$product->quantity} items available in stock."
                ], 422);
            }
            
            $cart[$key]['quantity'] = $newQuantity;
        } else {
            $cart[$key] = [
                'key' => $key,
                'product_id' => $product->id,
                'name' => $product->name,
                'price' => (float) round($price, 2),
                'original_price' => (float) $product->price,
                'quantity' => (int) $request->quantity,
                'color' => $request->color,
                'size' => $request->size,
                'image' => $product->media->first()?->url ?? asset('assets/images/product.png'),
            ];
        }

        session()->put('cart', $cart);

        return response()->json([
            'success' => true,
            'message' => 'Product added to cart successfully!',
            'cart' => $this->getCartSummary()
        ]);
    }

    /**
     * Update the quantity of a specific cart item.
     */
    public function update(Request $request, $key)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $cart = session()->get('cart', []);

        if (!isset($cart[$key])) {
            return response()->json([
                'success' => false,
                'message' => 'Cart item not found.'
            ], 404);
        }

        $product = Product::find($cart[$key]['product_id']);
        if (!$product) {
            unset($cart[$key]);
            session()->put('cart', $cart);
            return response()->json([
                'success' => false,
                'message' => 'Product no longer exists.'
            ], 404);
        }

        // Validate stock quantity
        if ($product->stock !== 'instock' || $product->quantity < $request->quantity) {
            return response()->json([
                'success' => false,
                'message' => "Only {$product->quantity} items available in stock."
            ], 422);
        }

        $cart[$key]['quantity'] = (int) $request->quantity;
        session()->put('cart', $cart);

        return response()->json([
            'success' => true,
            'message' => 'Cart updated successfully!',
            'cart' => $this->getCartSummary()
        ]);
    }

    /**
     * Remove an item from the cart.
     */
    public function remove($key)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$key])) {
            unset($cart[$key]);
            session()->put('cart', $cart);
        }

        return response()->json([
            'success' => true,
            'message' => 'Item removed from cart successfully.',
            'cart' => $this->getCartSummary()
        ]);
    }

    /**
     * Clear all items from the cart.
     */
    public function clear()
    {
        session()->forget('cart');

        return response()->json([
            'success' => true,
            'message' => 'Cart cleared successfully.',
            'cart' => $this->getCartSummary()
        ]);
    }

    /**
     * Format and retrieve full cart summary.
     */
    private function getCartSummary()
    {
        $cart = session()->get('cart', []);
        
        $count = 0;
        $subtotal = 0;
        
        foreach ($cart as $item) {
            $count += $item['quantity'];
            $subtotal += $item['price'] * $item['quantity'];
        }

        return [
            'items' => array_values($cart),
            'count' => $count,
            'subtotal' => (float) round($subtotal, 2),
            'subtotal_formatted' => number_format($subtotal, 2),
        ];
    }
}
