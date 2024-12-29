@extends('layouts.user_type.auth')

@section('content')
    <div class="container">
        <h1>Atur Orderan</h1>
        @foreach ($orders as $order)
            <div class="card mb-3">
                <div class="card-body">
                    <h5>Order #{{ $order->id }} by {{ $order->user->name }} - Status : {{ ucfirst($order->status) }}</h5>
                    <ul>
                        @foreach ($order->orderItems as $item)
                            <li>
                                {{ $item->product->name }} - Banyak Produk : {{ $item->quantity }} - Harga : RP {{ number_format($item->price, 0, ',', '.') }},00
                            </li>
                        @endforeach
                    </ul>
                    <p><strong>Harga Total : </strong> RP {{ number_format($order->total_price, 0, ',', '.') }},00</p>

                    <!-- Status actions -->
                    <div class="d-flex">
                        @if ($order->status === 'pending')
                            <form method="POST" action="{{ route('orders.approve', $order->id) }}" class="me-2">
                                @csrf
                                <button type="submit" class="btn btn-success">Terima Order</button>
                            </form>
                        @endif

                        @if ($order->status === 'paid')
                            <form method="POST"
                                action="{{ route('orders.update.status', ['order' => $order->id, 'status' => 'shipped']) }}"
                                class="me-2">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-warning">Tandai Sebagai Dikirim</button>
                            </form>
                        @endif

                        @if ($order->status === 'shipped')
                            <form method="POST"
                                action="{{ route('orders.update.status', ['order' => $order->id, 'status' => 'completed']) }}">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-primary">Tandai Sebagai Selesai</button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
