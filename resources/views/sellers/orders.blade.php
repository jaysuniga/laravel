@extends('layouts.sellerLayout')

@section('content')
    <div class="container">
        <h1>Orders</h1>

        @if($orders->isEmpty())
            <p>No orders found.</p>
        @else
            <table class="table">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Customer Name</th>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Total Price</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $orderItem)
                        <tr>
                            <td>{{ $orderItem->order->id }}</td>
                            <td>{{ $orderItem->order->user->name }}</td>
                            <td>{{ $orderItem->product->name }}</td>
                            <td>{{ $orderItem->quantity }}</td>
                            <td>₱{{ number_format($orderItem->price * $orderItem->quantity, 2) }}</td>
                            <td>
                                <form action="{{ route('orders.updateStatus', $orderItem->order->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <select name="status" onchange="this.form.submit()">
                                        <option value="Pending" {{ $orderItem->order->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="Processing" {{ $orderItem->order->status == 'Processing' ? 'selected' : '' }}>Processing</option>
                                        <option value="Completed" {{ $orderItem->order->status == 'Completed' ? 'selected' : '' }}>Completed</option>
                                        <option value="Cancelled" {{ $orderItem->order->status == 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
                                    </select>
                                </form>
                            </td>
                            <td></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection



