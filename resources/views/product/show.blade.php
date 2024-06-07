@extends('layouts.layout')
@section('cart')
    <a class="btn px-5 cart" href="{{route('cart.view')}}"><i class="fa-solid fa-cart-shopping"></i><span>{{ $cartCount }}</span></a>
@endsection
@section('content')
    <div class="container productpage">
        <div class="row">
            <div class="col-md-6">
                <img src="{{ asset('images/' . $product->photo) }}" alt="{{ $product->name }}" class="img-fluid">
            </div>
            <div class="col-md-6">
                <p>Category: {{ ucfirst($product->category) }}</p>
                <h2>{{ $product->name }}</h2>
                
                <h3>₱{{ number_format($product->price, 2) }}</h3>
                

                <p>{{ $product->description }}</p>
                <p>{{ $product->seller->name }}</p>
                <form action="{{ route('cart.add', $product->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-primary">Add to Cart</button>
                </form>
            </div>
        </div>
    </div>
@endsection
