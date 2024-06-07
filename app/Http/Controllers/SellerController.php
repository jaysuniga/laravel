<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Seller;
use App\Models\Product;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SellerController extends Controller
{
    public function dashboard()
    {
        $seller = auth()->user()->seller;
        $products = Product::where('seller_id', $seller->id)->get();
    
        return view('sellers.dashboard', compact('products', 'seller'));
    } 

    public function manage()
    {
        $seller = auth()->user()->seller;
        $products = Product::where('seller_id', $seller->id)->get();
    
        return view('sellers.manage', compact('products', 'seller'));
    } 
    
    public function registerSeller(Request $request)
    {
        $user = Auth::user(); // Get the authenticated user

        // Check if the user already has a seller account
        $seller = Seller::where('user_id', $user->id)->first();

        if ($seller) {
            // Redirect to the seller dashboard if the user already has a seller account
            return redirect()->route('sellers.dashboard');
        } else {
            // Show the registration form if the user does not have a seller account
            return view('sellers.registerSeller');
        }
    }

    public function registerHandler(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'cover_photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
    
        $coverPhotoPath = $request->file('cover_photo')->store('cover_photos', 'public');
    
        $user = auth()->user();
    
        $seller = Seller::create([
            'name' => $request->name,
            'cover_photo' => $coverPhotoPath,
            'user_id' => $user->id,
        ]);
    
        // Redirect to the dashboard route for the seller after registration
        return redirect()->route('sellers.dashboard')->with('success', 'Seller registration successful!');
    }
    

    public function orders()
    {
        $seller = auth()->user()->seller;
        $orders = OrderItem::whereHas('product', function ($query) use ($seller) {
            $query->where('seller_id', $seller->id);
        })->with(['order.user', 'product'])->get();
    
        return view('sellers.orders', compact('orders'));
    }
    
    
    public function updateStatus(Request $request, $orderId)
    {
        $request->validate([
            'status' => 'required|string|in:Pending,Processing,Completed,Cancelled',
        ]);
    
        $order = Order::findOrFail($orderId);
    
        // Check if the order contains products from the seller
        $seller = auth()->user()->seller;
        $containsSellerProduct = $order->items->contains(function($orderItem) use ($seller) {
            return $orderItem->product->seller_id == $seller->id;
        });
    
        if (!$containsSellerProduct) {
            return redirect()->route('sellers.orders')->with('error', 'You are not authorized to update the status of this order.');
        }
    
        $order->status = $request->status;
        $order->save();
    
        return redirect()->route('sellers.orders')->with('success', 'Order status updated successfully.');
    }
    

    
    
}
