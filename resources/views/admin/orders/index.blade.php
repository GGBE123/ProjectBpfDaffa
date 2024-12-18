@extends('layouts.user_type.auth')

@section('content')
    <div class="container">
        <h2>Manage Orders</h2>
        @foreach ($orders as $order)
            <div class="card mb-3">
                <div class="card-body">
                    <h5>Order #{{ $order->id }} by {{ $order->user->name }} - Status: {{ ucfirst($order->status) }}</h5>
                    <ul>
                        @foreach ($order->orderItems as $item)
                            <li>
                                {{ $item->product->name }} - Quantity: {{ $item->quantity }} - Price: ${{ $item->price }}
                            </li>
                        @endforeach
                    </ul>
                    <p><strong>Total:</strong> ${{ $order->total_price }}</p>

                    <!-- Status actions -->
                    <div class="d-flex">
                        @if ($order->status === 'pending')
                            <form method="POST" action="{{ route('orders.approve', $order->id) }}" class="me-2">
                                @csrf
                                <button type="submit" class="btn btn-success">Approve Order</button>
                            </form>
                        @endif

                        @if ($order->status === 'paid')
                            <form method="POST"
                                action="{{ route('orders.update.status', ['order' => $order->id, 'status' => 'shipped']) }}"
                                class="me-2">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-warning">Mark as Shipped</button>
                            </form>
                        @endif

                        @if ($order->status === 'shipped')
                            <form method="POST"
                                action="{{ route('orders.update.status', ['order' => $order->id, 'status' => 'completed']) }}">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-primary">Mark as Completed</button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
