@extends('layouts.user_type.auth')

@section('content')
<div class="container">
    <h1>Keranjang</h1>

    @if(session('cart') && count($cart) > 0)
    <table class="table">
        <thead>
            <tr>
                <th>Produkt</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Subtotal</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($cart as $item)
            <tr>
                <td>{{ $item['name'] }}</td>
                <td>RP {{ number_format($item['price'], 0, ',', '.') }},00</td>
                <td>
                    <form action="{{ route('cart.update', $item['id']) }}" method="POST">
                        @csrf
                        <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" style="width: 60px;">
                        <button type="submit" class="btn btn-sm btn-success">Update</button>
                    </form>
                </td>
                <td>RP {{ number_format($item['subtotal'], 0, ',', '.') }},00</td>
                <td>
                    <form action="{{ route('cart.remove', $item['id']) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">Keluarkan</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="text-end">
        <h4>Total : RP {{ number_format($total, 0, ',', '.') }},00</h4>
        <form action="{{ route('cart.checkout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-success">Checkout</button>
        </form>
    </div>
    @else
    <p>Keranjang Kosong!</p>
    @endif
</div>
@endsection
