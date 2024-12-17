@extends('layouts.user_type.auth')

@section('content')
<div class="container">
    <h2>Your Orders</h2>
    @foreach($orders as $order)
        <div class="card mb-3">
            <div class="card-body">
                <h5>Order #{{ $order->id }} - Status: {{ ucfirst($order->status) }}</h5>
                <ul>
                    @foreach($order->orderItems as $item)
                        <li>
                            {{ $item->product->name }} - Quantity: {{ $item->quantity }} - Price: ${{ $item->price }}
                        </li>
                    @endforeach
                </ul>
                <p><strong>Total:</strong> ${{ $order->total_price }}</p>
            </div>
        </div>
    @endforeach
</div>
@endsection
