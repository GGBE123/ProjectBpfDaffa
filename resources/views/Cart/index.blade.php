@extends('layouts.user_type.auth')

@section('content')
<div class="container">
    <h1>Your Cart</h1>

    @if(session('cart') && count($cart) > 0)
    <table class="table">
        <thead>
            <tr>
                <th>Product</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Subtotal</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($cart as $item)
            <tr>
                <td>{{ $item['name'] }}</td>
                <td>${{ $item['price'] }}</td>
                <td>
                    <form action="{{ route('cart.update', $item['id']) }}" method="POST">
                        @csrf
                        <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" style="width: 60px;">
                        <button type="submit" class="btn btn-sm btn-success">Update</button>
                    </form>
                </td>
                <td>${{ $item['subtotal'] }}</td>
                <td>
                    <form action="{{ route('cart.remove', $item['id']) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">Remove</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="text-end">
        <h4>Total: ${{ $total }}</h4>
        <form action="{{ route('cart.checkout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-success">Checkout</button>
        </form>
    </div>
    @else
    <p>Your cart is empty.</p>
    @endif
</div>
@endsection
