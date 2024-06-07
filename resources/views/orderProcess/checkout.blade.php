@extends('layouts.layout')

@section('content')
    <div class="container cartpage2 pt-5">
        <a class="back text-dark" href="{{route('cart.view')}}"><i class="fa-solid fa-arrow-left pe-2"></i>Return to Cart</a>
        <h1 class="py-2">Checkout</h1>
        
        <div class="cart-grid">
        @if ($cartItems->isEmpty())
            <p>Your cart is empty.</p>
        @else
            <div class="cart-frame">
                <div class="table-grid">
                    <div class="customer border mb-4">
                        <h3>Customer Info</h3>
                        <div>
                            <p>Name:{{ $user->name }}</p>
                        </div>
                        <div>
                            <p>Email Address:{{ $user->email }}</p>
                        </div>
                    </div>
                    <div class="shipping border mb-4">
                        <h3>Shipping Address</h3>
                        <form action="{{ route('checkout.process') }}" method="POST" id="checkoutForm">
                            @csrf
                            @method('POST')
                            <div class="form-group">
                                <label for="shipping_address">Shipping Address</label>
                                <input type="text" class="form-control" id="shipping_address" name="shipping_address" required>
                            </div>
                            <div class="form-group">
                                <label for="shipping_city">Shipping City</label>
                                <input type="text" class="form-control" id="shipping_city" name="shipping_city" required>
                            </div>
                            <div class="form-group">
                                <label for="contact">Contact Number</label>
                                <input type="text" class="form-control" id="contact" name="contact" required>
                            </div>
                        </form>
                    </div>

                    <div class="labels border-bottom py-2">
                        <div>Image</div>
                        <div>Product</div>
                        <div>Price</div>
                        <div>Quantiy</div>
                        <div>Subtotal</div>
                    </div>
                    @foreach($cartItems as $cartItem)
                    <div class="cart-items py-2 border-bottom">                            
                        <div><img src="{{ asset('images/' . $cartItem->product->photo) }}" alt="{{ $cartItem->product->name }}" class="img-fluid"></div>
                        <div><p class="name">{{ $cartItem->product->name }}</p></div>
                        <div>₱{{ number_format($cartItem->product->price, 2) }}</div>
                        <div>{{ $cartItem->quantity}}</div>
                        <div>₱{{ number_format($cartItem->product->price * $cartItem->quantity, 2) }}</div>                            
                    </div>
                    @endforeach
                </div>                        
            </div>
                        
            <div class="total-price">
                <div class="title border p-2">Order Details</div>

                <div class="cart-total p-4">
                    <h3 class="pb-3">Cart Totals</h3>
                    <p>Total: <b class="px-4">₱{{ number_format($totalPrice, 2) }}</b></p>
                    <div>
                        <button type="submit" class="btn btn-dark w-100" id="placeOrderBtn">Place Order</button>
                    </div>
                </div>
            </div>
        @endif
        </div>

    </div>

    <script>
        document.getElementById('placeOrderBtn').addEventListener('click', function() {
            var form = document.getElementById('checkoutForm');
            if (form.checkValidity()) {
                form.submit();
            } else {
                form.reportValidity();
            }
        });
    </script>
@endsection
