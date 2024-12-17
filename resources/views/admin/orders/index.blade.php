@extends('layouts.user_type.auth')

@section('content')
<div class="container">
    <h2>Manage Orders</h2>
    @foreach($orders as $order)
        <div class="card mb-3">
            <div class="card-body">
                <h5>Order #{{ $order->id }} by {{ $order->user->name }} - Status: {{ ucfirst($order->status) }}</h5>
                <ul>
                    @foreach($order->orderItems as $item)
                        <li>
                            {{ $item->product->name }} - Quantity: {{ $item->quantity }} - Price: ${{ $item->price }}
                        </li>
                    @endforeach
                </ul>
                <p><strong>Total:</strong> ${{ $order->total_price }}</p>
                @if($order->status === 'pending')
                    <form method="POST" action="{{ route('orders.approve', $order->id) }}">
                        @csrf
                        <button type="submit" class="btn btn-success">Approve Order</button>
                    </form>
                @endif
            </div>
        </div>
    @endforeach
</div>
@endsection
