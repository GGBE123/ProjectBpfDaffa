@extends('layouts.user_type.auth') <!-- Extending layout file for user authentication -->

@section('content')
<div class="container">
    <h1>Add Product</h1>
    <!-- Form to add a product, POST request sent to 'products.store' route -->
    <<form action="{{ route('products.store') }}" method="POST">
        @csrf <!-- CSRF Token for security -->
    
        <div class="mb-3">
            <label for="name" class="form-label">Product Name</label>
            <input type="text" id="name" name="name" class="form-control" required>
        </div>
    
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea id="description" name="description" class="form-control"></textarea>
        </div>
    
        <div class="mb-3">
            <label for="price" class="form-label">Price</label>
            <input type="number" id="price" name="price" class="form-control" required>
        </div>
    
        <div class="mb-3">
            <label for="stock" class="form-label">Stock</label>
            <input type="number" id="stock" name="stock" class="form-control" required>
        </div>
    
        @if(isset($categories) && $categories->count())
        <div class="mb-3">
            <label for="category" class="form-label">Category</label>
            <select id="category" name="category_id" class="form-select">
                <option value="">Select Category</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        @endif
    
        <button type="submit" class="btn btn-primary">Add Product</button>
    </form>
    
</div>
@endsection
