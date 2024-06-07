@extends('layouts.sellerLayout')
@section('content')
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <div class="container">
        <h1>Manage Product</h1>
        @if($products->isEmpty())
            <p>You have no products yet.</p>
        @else
            <table class="table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Photo</th>
                        <th>Description</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Category</th>
                        <th>Actions</th> <!-- Add Actions Column -->
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                        <tr>
                            <td>{{ $product->name }}</td>
                            <td><img src="{{ asset('images/' . $product->photo) }}" alt="{{ $product->name }}" width="50"></td>
                            <td>{{ $product->description }}</td>
                            <td>{{ $product->qty }}</td>
                            <td>₱{{ number_format($product->price, 2) }}</td>
                            <td>{{ $product->category }}</td>
                            <td>
                                <div class="d-flex">
                                <!-- Edit Button -->
                                <button class="btn btn-warning btn-sm mx-1" data-bs-toggle="modal" data-bs-target="#editProductModal{{ $product->id }}">Edit</button>

                                <!-- Delete Button -->
                                <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteProductModal{{ $product->id }}">Delete</button>
                                </div>
                            </td>
                        </tr>

                        <!-- Edit Product Modal -->
                        <div class="modal fade" id="editProductModal{{ $product->id }}" tabindex="-1" aria-labelledby="editProductModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editProductModalLabel">Edit Product</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="photo">Product Photo</label>
                                                <input type="file" name="photo" id="photo" class="form-control-file" accept="image/*">
                                            </div>
                                            <div class="form-group">
                                                <label for="name">Product Name</label>
                                                <input type="text" name="name" id="name" class="form-control" value="{{ $product->name }}" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="description">Description</label>
                                                <textarea name="description" id="description" class="form-control" required>{{ $product->description }}</textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="qty">Quantity</label>
                                                <input type="number" name="qty" id="qty" class="form-control" value="{{ $product->qty }}" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="price">Price</label>
                                                <input type="number" name="price" id="price" class="form-control" step="0.01" value="{{ $product->price }}" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="category">Category</label>
                                                <select name="category" id="category" class="form-control" required>
                                                    <option value="ring" {{ $product->category == 'ring' ? 'selected' : '' }}>Ring</option>
                                                    <option value="bracelet" {{ $product->category == 'bracelet' ? 'selected' : '' }}>Bracelet</option>
                                                    <option value="earrings" {{ $product->category == 'earrings' ? 'selected' : '' }}>Earrings</option>
                                                    <option value="necklace" {{ $product->category == 'necklace' ? 'selected' : '' }}>Necklace</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Save Changes</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- Delete Product Modal -->
                        <div class="modal fade" id="deleteProductModal{{ $product->id }}" tabindex="-1" aria-labelledby="deleteProductModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteProductModalLabel">Delete Product</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Are you sure you want to delete this product?
                                    </div>
                                    <div class="modal-footer">
                                        <form action="{{ route('products.destroy', $product->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection

