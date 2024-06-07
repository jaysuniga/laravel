@extends('layouts.sellerLayout')
@section('content')

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <div class="container">
        <h1>Create Product</h1>
        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="photo">Product Photo</label>
                <input type="file" name="photo" id="photo" class="form-control-file" accept="image/*" required>
            </div>
            <div class="form-group">
                <label for="name">Product Name</label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" class="form-control" required></textarea>
            </div>
            <div class="form-group">
                <label for="qty">Quantity</label>
                <input type="number" name="qty" id="qty" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="price">Price</label>
                <input type="number" name="price" id="price" class="form-control" step="0.01" required>
            </div>
            <div class="form-group">
                <label for="category">Category</label>
                <select name="category" id="category" class="form-control" required>
                    <option value="ring">Ring</option>
                    <option value="bracelet">Bracelet</option>
                    <option value="earrings">Earrings</option>
                    <option value="necklace">Necklace</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Create Product</button>
        </form>
    </div>
@endsection

