@extends('layouts.layout')
@section('cart')
    <a class="btn px-5 cart" href="{{route('cart.view')}}"><i class="fa-solid fa-cart-shopping"></i><span>{{ $cartCount }}</span></a>
@endsection
@section('content')
    <section>
        <div class="section5 d-flex flex-column align-items-center">
            <div class="container header d-flex justify-content-center align-items-center">
                <h2 class="text-uppercase text-light"><b>Products</b></h2>
            </div>
            <div class="container hero-grid">
                <div class="sidebar">
                    <form action="{{ route('shop') }}" method="GET">
                        <div class="form-group">
                            <div class="d-flex align-items-center search">
                                <i class="fa-solid fa-magnifying-glass"></i>
                                <input type="text" name="search" id="search" placeholder="Search..." value="{{ request('search') }}">   
                            </div>                         
                        </div>
                        <div class="form-group mt-3 category">
                            <label class="title">Categories</label>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="category[]" value="ring" id="ring" {{ in_array('ring', (array)request('category')) ? 'checked' : '' }}>
                                <label class="form-check-label" for="ring">Ring</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="category[]" value="bracelet" id="bracelet" {{ in_array('bracelet', (array)request('category')) ? 'checked' : '' }}>
                                <label class="form-check-label" for="bracelet">Bracelet</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="category[]" value="earrings" id="earrings" {{ in_array('earrings', (array)request('category')) ? 'checked' : '' }}>
                                <label class="form-check-label" for="earrings">Earrings</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="category[]" value="necklace" id="necklace" {{ in_array('necklace', (array)request('category')) ? 'checked' : '' }}>
                                <label class="form-check-label" for="necklace">Necklace</label>
                            </div>                            
                        </div>
                        <button type="submit" class="btn btn-dark px-4 w-100">Apply</button>
                    </form>

                    <div class="popular mt-4 p-2">
                        <div class="title">
                            <p>Popular products</p>
                        </div>
                        <div class="product-frame">
                            @foreach($products->slice(0, 3) as $product)
                            <a href="{{ route('product.show', $product->id) }}" class="product">
                                <div class="d-flex pop">
                                    <div class="product-img"><img src="{{ asset('images/' . $product->photo) }}" alt="{{ $product->name }}" class="img-fluid"></div>
                                    <div class="d-flex flex-column justify-content-center">
                                        <div class="product-name px-2"><p>{{ $product->name }}</p></div>
                                        <div class="product-price px-2">₱{{ number_format($product->price, 2) }}</div>
                                    </div>
                                </div>
                            </a>
                            @endforeach 
                        </div>                       
                    </div>
                </div>
                
                @if($products->isEmpty())
                    <p class="text-center">No products found.</p>
                @else
                <div class="grid-frame">  
                    @foreach($products as $product)
                    <a href="{{ route('product.show', $product->id) }}" class="product">
                        <div class="product-img"><img src="{{ asset('images/' . $product->photo) }}" alt="{{ $product->name }}" class="img-fluid"></div>
                        <div class="product-name px-2"><p>{{ $product->name }}</p></div>
                        <div class="product-price px-2">₱{{ number_format($product->price, 2) }}</div>
                    </a>
                    @endforeach
                </div>
                @endif
            </div>
        </div>
    </section>
@endsection
