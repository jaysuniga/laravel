@extends('layouts.layout')
@section('cart')
    <a class="btn px-5 cart" href="{{route('cart.view')}}"><i class="fa-solid fa-cart-shopping"></i><span>{{ $cartCount }}</span></a>
@endsection
@section('content')
    <section class="container-fluid">
        <div class="hero rounded d-flex align-items-center">
            <div class="container hero-grid">
                <div class="grid-text">
                    <h1 class="text-uppercase"><b>Timeless Jewelry for Every Moment</b></h1>
                    <p>Explore our exquisite collection of handcrafted jewelry, from dazzling diamonds to unique artisan pieces. Elevate your style and celebrate life’s special moments with our timeless designs.</p>
                    <div>
                        <button class="btn btn-dark rounded-1 px-4">Shop Now</button>
                        <button class="btn btn-light border border-dark rounded-1 px-4">About Us</button>
                    </div>
                </div>
                
                <div class="grid-frame d-flex align-items-center">                    
                    <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-indicators">
                            <button type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                            <button type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide-to="1" aria-label="Slide 2"></button>
                            <button type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide-to="2" aria-label="Slide 3"></button>
                        </div>
                        <div class="carousel-inner">
                          <div class="carousel-item active">
                            <img class="img-fluid" src="../bg-images/jewelry1.jpg" alt="">
                          </div>
                          <div class="carousel-item">
                            <img class="img-fluid" src="../bg-images/jewelry2.jpg" alt="">
                          </div>
                          <div class="carousel-item">
                            <img class="img-fluid" src="../bg-images/jewelry3.jpg" alt="">
                          </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
                          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                          <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
                          <span class="carousel-control-next-icon" aria-hidden="true"></span>
                          <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="section2 d-flex align-items-center">
            <div class="container hero-grid">
                <div class="grid-text">
                    <h5>Discover Our Legacy</h5>
                    <h2 class="text-uppercase"><b>Tradition and Innovation: The Story of Anniezone Jewelry Shop</b></h2>
                    <p class="pb-4">
                        Welcome to Anniezone Jewelry Shop, where elegance meets craftsmanship. 
                        Our passion for creating timeless jewelry pieces is reflected in every design we offer. 
                        Each piece is meticulously handcrafted using the finest materials to ensure exceptional quality and beauty.
                    </p>
                </div>

                <div class="grid-text2">
                    <h6><b>Our Mission</b></h6>
                    <p>
                        We aim to bring you jewelry that not only enhances your style but also tells a story of artistry and tradition. 
                        From everyday wear to special occasions, our pieces are designed to celebrate life’s precious moments.
                    </p>

                    <h6><b>Our Values</b></h6>

                    <ul>
                        <li><i class="fa-solid fa-square-check"></i><b> Quality</b>: Uncompromising commitment to the highest standards.</li>
                        <li><i class="fa-solid fa-square-check"></i><b> Artistry</b>: Unique designs that blend classic and modern elements.</li>
                        <li><i class="fa-solid fa-square-check"></i><b> Sustainability</b>: Ethical sourcing and environmentally-friendly practices.</li>
                    </ul>
                </div>
                <div class="grid-frame d-flex align-items-center justify-content-center">   
                    <img class="" src="../bg-images/about.jpg" alt="">                 
                </div>

                <div class="grid-frame2 d-flex align-items-center justify-content-center">   
                    <img class="" src="../bg-images/about2.jpg" alt="">                 
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="section3 d-flex align-items-center">
            <div class="container hero-grid">
                <div class="grid-frame d-flex align-items-center justify-content-center">   
                    <a href="{{ route('shop')}}">RINGS</a>
                </div>
                <div class="grid-frame d-flex align-items-center justify-content-center">   
                    <a href="{{ route('shop') }}">BRACELET</a>
                </div>
                <div class="grid-frame d-flex align-items-center justify-content-center">   
                    <a href="{{ route('shop') }}">NECKLACE</a>
                </div>
                <div class="grid-frame d-flex align-items-center justify-content-center">   
                    <a href="{{ route('shop') }}">EARINGS</a>
                </div>
            </div>
        </div>
    </section>
    

    <section>
        <div class="section4 d-flex align-items-center">
            <div class="container hero-grid">
                <div class="grid-text text-center">
                    <h5>Order Now</h5>
                    <h2 class="text-uppercase"><b>Best Selling Products</b></h2>
                </div>

                @if($products->isEmpty())
                    <p class="text-center">You have no products yet.</p>                
                @else
                <div class="grid-frame">  
                    @foreach($products->take(4) as $product)
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
