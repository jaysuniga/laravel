<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\CartItem;
use App\Models\Cart;


class UserController extends Controller
{
    public function home()
    {
        $products = Product::all();
        $cartCount = 0;

        // Check if the user is authenticated
        if (auth()->check()) {
            // Get the user's cart if it exists
            $userCart = auth()->user()->cart;

            // Ensure that the user has a cart before accessing its items
            if ($userCart) {
                // Calculate the cart count based on the sum of quantities in the cart
                $cartCount = $userCart->items->sum('quantity');
            }
        }

        return view('home', ['products' => $products, 'cartCount' => $cartCount]);
    }

    public function shop(Request $request)
    {
        $query = Product::query();
    
        if ($search = $request->input('search')) {
            $query->where('name', 'LIKE', "%{$search}%");
        }
    
        if ($categories = $request->input('category')) {
            $query->whereIn('category', $categories);
        }
    
        $products = $query->get();
        $cartCount = 0;
    
        if (auth()->check()) {
            $userCart = auth()->user()->cart;
            if ($userCart) {
                $cartCount = $userCart->items->sum('quantity');
            }
        }
    
        return view('shop', ['products' => $products, 'cartCount' => $cartCount]);
    }
    

    public function register(){
        return view('auth.register');
    }
    
    public function registerHandler(Request $request){
        $data = $request->validate([
                'name' => ['required',Rule::unique('users','name')],
                'email' => ['required','email',Rule::unique('users','email')],
                'password' => 'required'
        ]);

        $data['password'] = bcrypt($data['password']);
        $newUser = User::create($data);

        auth()->login($newUser);

        return redirect('/');
    }

    public function login(){
        return view('auth.login');
    }

    public function loginHandler(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
    
        if (auth()->attempt(['email' => $data['email'], 'password' => $data['password']])) {
            $request->session()->regenerate();
            return redirect()->intended('/'); // Redirect to intended page or default to '/'
        }
    
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->withInput($request->only('email'));
    }
    

    public function logout(){
        auth()->logout();
        return redirect('/');
    }

}
