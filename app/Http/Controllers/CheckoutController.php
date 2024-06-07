<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;

class CheckoutController extends Controller
{
    public function show()
    {
        $user = auth()->user(); // Get the authenticated user


        // Get the user's cart items
        $cartItems = $user->cart->items ?? collect();

        // Calculate the total price
        $totalPrice = $cartItems->sum(function ($cartItem) {
            return $cartItem->product->price * $cartItem->quantity;
        });
    
        return view('orderProcess.checkout', compact('user', 'cartItems', 'totalPrice'));
    }
    
    


    public function process(Request $request)
    {
        // Get the authenticated user
        $user = auth()->user();

        // Retrieve all cart items for the user
        $cartItems = $user->cart->items;

        // Create a new order
        $order = new Order();
        $order->user_id = $user->id;
        $order->shipping_address = $request->shipping_address;
        $order->shipping_city = $request->shipping_city;
        $order->contact = $request->contact;
        $order->status = 'Pending'; // Set initial status
        $order->total_price = 0; // Initialize total price
        $order->save();

        // Calculate the total price of the order
        $totalPrice = 0;
        foreach ($cartItems as $cartItem) {
            $totalPrice += $cartItem->product->price * $cartItem->quantity;
        }

        // Add order items to the order and update product quantities
        foreach ($cartItems as $cartItem) {
            $orderItem = new OrderItem();
            $orderItem->order_id = $order->id;
            $orderItem->product_id = $cartItem->product_id;
            $orderItem->quantity = $cartItem->quantity;
            $orderItem->price = $cartItem->product->price; // Store the product price at the time of ordering
            $orderItem->save();

            // Decrease the product's quantity
            $product = $cartItem->product;
            $product->qty -= $cartItem->quantity;
            if ($product->qty < 0) {
                return redirect()->route('cart.view')->with('error', 'Not enough stock for product: ' . $product->name);
            }
            $product->save();
        }

        // Update the total price of the order
        $order->total_price = $totalPrice;
        $order->save();

        // Clear the user's cart after checkout
        $user->cart->items()->delete();

        // Redirect the user to the orders page
        return redirect()->route('cart.view')->with('success', 'Order placed successfully!');
    }
}
