<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\CartItem;
use Illuminate\Http\Request;

class CartController extends Controller
{


    public function add(Request $request, $productId)
    {
        $product = Product::findOrFail($productId);

        // Get the authenticated user
        $user = auth()->user();
        
        // Get or create the user's cart
        $cart = $user->cart ?? new Cart();
        $cart->user_id = $user->id;
        $cart->save();

        // Check if the product is already in the cart
        $cartItem = $cart->items()->where('product_id', $productId)->first();
        
        if ($cartItem) {
            // If the product is already in the cart, update the quantity
            $cartItem->quantity += 1;
            $cartItem->save();
        } else {
            // If the product is not in the cart, create a new cart item
            $cart->items()->create(['product_id' => $product->id, 'quantity' => 1]);
        }

        // Update session with cart items
        $cartItems = $cart->items;
        session()->put('cartItems', $cartItems);

        return redirect()->back()->with('success', 'Product added to cart.');
    }



    public function viewCart()
    {
        // Get the authenticated user
        $user = auth()->user();

        // Get the user's cart items
        $cartItems = $user->cart->items ?? collect();

        // Calculate the total price
        $totalPrice = $cartItems->sum(function ($cartItem) {
            return $cartItem->product->price * $cartItem->quantity;
        });

        return view('orderProcess.cart', compact('cartItems', 'totalPrice'));
    }

    public function updateQuantity(Request $request, $cartItemId)
    {
        $cartItem = CartItem::findOrFail($cartItemId);
        $cartItem->quantity = $request->quantity;
        $cartItem->save();

        return response()->json(['success' => true]);
    }

    public function deleteMultiple(Request $request)
    {
        $selectedItems = $request->input('selectedItems', []);

        foreach ($selectedItems as $itemId) {
            $cartItem = CartItem::find($itemId);
            if ($cartItem) {
                $cartItem->delete();
            }
        }

        return redirect()->back()->with('success', 'Selected items deleted from the cart.');
    }

}
