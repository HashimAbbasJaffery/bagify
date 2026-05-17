<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function index() {
        // If cart is empty, redirect back to shop
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('home.shop')->with('error', 'Your cart is empty.');
        }
        return view("checkout");
    }

    public function store(Request $request) {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'street_address' => 'required|string|max:255',
            'postcode' => 'required|string|max:20',
            'city' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'notes' => 'nullable|string',
        ]);

        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return response()->json([
                'success' => false,
                'message' => 'Your cart is empty.'
            ], 422);
        }

        // Calculate subtotal
        $subtotal = 0;
        foreach ($cart as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }

        // Wrap execution in database transaction for transactional integrity
        $dbOrder = DB::transaction(function() use ($request, $cart, $subtotal) {
            $order = Order::create([
                'order_number' => 'BGFY-' . strtoupper(substr(uniqid(), 7)),
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'country' => $request->country,
                'street_address' => $request->street_address,
                'postcode' => $request->postcode,
                'city' => $request->city,
                'phone' => $request->phone,
                'email' => $request->email,
                'notes' => $request->notes,
                'subtotal' => $subtotal,
                'total' => $subtotal,
                'status' => 'pending'
            ]);

            foreach ($cart as $item) {
                $order->items()->create([
                    'product_id' => $item['product_id'],
                    'name' => $item['name'],
                    'price' => $item['price'],
                    'quantity' => $item['quantity'],
                    'color' => $item['color'] ?? null,
                    'size' => $item['size'] ?? null,
                ]);
            }

            return $order;
        });

        // Format order details for the session-backed success receipt view
        $orderData = [
            'order_number' => $dbOrder->order_number,
            'billing' => [
                'first_name' => $dbOrder->first_name,
                'last_name' => $dbOrder->last_name,
                'country' => $dbOrder->country,
                'street_address' => $dbOrder->street_address,
                'postcode' => $dbOrder->postcode,
                'city' => $dbOrder->city,
                'phone' => $dbOrder->phone,
                'email' => $dbOrder->email,
                'notes' => $dbOrder->notes,
            ],
            'items' => array_map(function($item) {
                return [
                    'name' => $item['name'],
                    'price' => $item['price'],
                    'quantity' => $item['quantity'],
                    'color' => $item['color'] ?? null,
                    'size' => $item['size'] ?? null,
                    'image' => $item['image'],
                ];
            }, array_values($cart)),
            'subtotal' => $dbOrder->subtotal,
            'total' => $dbOrder->total,
            'date' => $dbOrder->created_at->format('F d, Y'),
        ];

        // Keep last order details in session to power the order success screen
        session()->put('last_order', $orderData);
        
        // Purge session cart state
        session()->forget('cart');

        return response()->json([
            'success' => true,
            'message' => 'Order placed successfully!',
            'redirect' => route('home.order-success')
        ]);
    }

    public function success() {
        $order = session()->get('last_order');
        if (!$order) {
            return redirect()->route('home.shop');
        }
        return view("order-success", compact('order'));
    }
}
