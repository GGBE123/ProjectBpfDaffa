@extends('layouts.user_type.auth')

@section('content')
<div class="container">
    <h1>Manage Products</h1>
    <a href="{{ route('products.add') }}" class="btn btn-primary mb-3">Add Product</a>
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Category</th>
                <th>Price</th>
                <th>Stock</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($products as $product)
            <tr>
                <td>{{ $product->id }}</td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->category->name ?? 'N/A' }}</td>
                <td>${{ $product->price }}</td>
                <td>{{ $product->stock }}</td>
                <td>
                    <!-- Trigger Modal -->
                    <a href="#editModal{{ $product->id }}" class="btn btn-warning btn-sm" data-bs-toggle="modal">Edit</a>

                    <!-- Delete Form -->
                    <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>

            <!-- Edit Modal -->
            <div class="modal fade" id="editModal{{ $product->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $product->id }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editModalLabel{{ $product->id }}">Edit Product</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('products.update', $product->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="name{{ $product->id }}" class="form-label">Product Name</label>
                                    <input type="text" class="form-control" id="name{{ $product->id }}" name="name" value="{{ $product->name }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="description{{ $product->id }}" class="form-label">Description</label>
                                    <textarea class="form-control" id="description{{ $product->id }}" name="description" rows="3" required>{{ $product->description }}</textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="price{{ $product->id }}" class="form-label">Price</label>
                                    <input type="number" class="form-control" id="price{{ $product->id }}" name="price" value="{{ $product->price }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="stock{{ $product->id }}" class="form-label">Stock</label>
                                    <input type="number" class="form-control" id="stock{{ $product->id }}" name="stock" value="{{ $product->stock }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="category_id{{ $product->id }}" class="form-label">Category</label>
                                    <select id="category_id{{ $product->id }}" name="category_id" class="form-select" required>
                                        <option value="">Select Category</option>
                                        @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                        @endforeach
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
            @empty
            <tr>
                <td colspan="6">No products available.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    {{ $products->links() }}
</div>
@endsection
