<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'required|string',
            'qty' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0',
            'category' => 'required|in:ring,bracelet,earrings,necklace'
        ]);

        $imageName = time().'.'.$request->photo->extension();  
        $request->photo->move(public_path('images'), $imageName);

        $product = Product::create([
            'name' => $request->name,
            'photo' => $imageName,
            'description' => $request->description,
            'qty' => $request->qty,
            'price' => $request->price,
            'category' => $request->category,
            'seller_id' => auth()->user()->seller->id,
        ]);

        return redirect()->route('sellers.dashboard')->with('success', 'Product created successfully!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'photo' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'required|string',
            'qty' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0',
            'category' => 'required|in:ring,bracelet,earrings,necklace'
        ]);

        $product = Product::findOrFail($id);
        $product->name = $request->name;
        $product->description = $request->description;
        $product->qty = $request->qty;
        $product->price = $request->price;
        $product->category = $request->category;

        if ($request->hasFile('photo')) {
            $imageName = time().'.'.$request->photo->extension();  
            $request->photo->move(public_path('images'), $imageName);
            $product->photo = $imageName;
        }

        $product->save();

        return redirect()->route('sellers.dashboard')->with('success', 'Product updated successfully!');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('sellers.dashboard')->with('success', 'Product deleted successfully!');
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        $cartCount = 0;

        if (auth()->check()) {
            $userCart = auth()->user()->cart;
            if ($userCart) {
                $cartCount = $userCart->items->sum('quantity');
            }
        }

        return view('product.show', ['product' => $product, 'cartCount' => $cartCount]);
    }

}
