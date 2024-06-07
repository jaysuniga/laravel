@extends('layouts.layout')

@section('content')
    <div class="container cartpage pt-5">
        <a class="back text-dark" href="{{route('shop')}}"><i class="fa-solid fa-arrow-left pe-2"></i>Return to Shop</a>
        <h1 class="py-2">Shopping Cart</h1>
        
        <div class="cart-grid">
        @if ($cartItems->isEmpty())
            <p>Your cart is empty.</p>
        @else
            <div class="cart-frame">
                <form action="{{ route('cart.delete.multiple') }}" method="POST" id="deleteForm">
                    @csrf
                    @method('DELETE')
                    <div class="table-grid border">
                        <div class="labels border-bottom py-2">
                            <div>Select</div>
                            <div>Image</div>
                            <div>Product</div>
                            <div>Price</div>
                            <div>Quantiy</div>
                            <div>Subtotal</div>
                        </div>
                        @foreach($cartItems as $cartItem)
                        <div class="cart-items py-2 border-bottom">                            
                            <div class=" d-flex align-items-center justify-content-center"><input type="checkbox" name="selectedItems[]" value="{{ $cartItem->id }}"></div>
                            <div><img src="{{ asset('images/' . $cartItem->product->photo) }}" alt="{{ $cartItem->product->name }}" class="img-fluid"></div>
                            <div><p class="name">{{ $cartItem->product->name }}</p></div>
                            <div>₱{{ number_format($cartItem->product->price, 2) }}</div>
                            <div><input type="number" class="form-control quantity-input qty" data-id="{{ $cartItem->id }}" value="{{ $cartItem->quantity }}" min="1"></div>
                            <div>₱{{ number_format($cartItem->product->price * $cartItem->quantity, 2) }}</div>                            
                        </div>
                        @endforeach

                        <div class="p-2" style="background-color: #EBECED">
                            <button type="submit" class="btn btn-dark"><i class="fa-solid fa-trash pe-2"></i>Delete Selected</button>
                        </div>
                    </div>                        
                </form>
            </div>
                        
            <div class="total-price">
                <div class="title border p-2">Order Details</div>

                <div class="cart-total p-4">
                    <h3 class="pb-3">Cart Totals</h3>
                    <p>Total: <b class="px-4">₱{{ number_format($totalPrice, 2) }}</b></p>
                    <div>
                        <a href="{{ route('checkout.show') }}" class="btn btn-dark w-100">Proceed to Checkout</a>
                    </div>
                </div>
            </div>
        @endif
        </div>

    </div>

    <script>
        document.querySelectorAll('.quantity-input').forEach(input => {
            input.addEventListener('change', function() {
                const cartItemId = this.getAttribute('data-id');
                const quantity = this.value;

                fetch(`/cart/update/${cartItemId}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ quantity })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload(); // Reload the page to update the total price and cart items
                    } else {
                        alert('Failed to update quantity.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred while updating the quantity.');
                });
            });
        });
    </script>
@endsection
