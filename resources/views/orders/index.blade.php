@extends('layouts.user_type.auth')

@section('content')
    <div class="container">
        <h1>Order</h1>
        @foreach ($orders as $order)
            <div class="card mb-3">
                <div class="card-body">
                    <h5>Order #{{ $order->id }} - Status : {{ ucfirst($order->status) }}</h5>
                    <ul>
                        @foreach ($order->orderItems as $item)
                            <li>
                                {{ $item->product->name }} - Jumlah Produk : {{ $item->quantity }} - Harga : RP
                                {{ number_format($item->price, 0, ',', '.') }},00
                            </li>
                        @endforeach
                    </ul>
                    <p><strong>Total Harga : </strong> RP {{ number_format($order->total_price, 0, ',', '.') }},00</p>
                </div>
        @endforeach
    </div>
@endsection
