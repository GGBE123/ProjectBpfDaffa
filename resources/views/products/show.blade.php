@extends(Auth::check() ? 'layouts.user_type.auth' : 'layouts.user_type.guest')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="img-fluid">
        </div>
        <div class="col-md-6">
            <h1>{{ $product->name }}</h1>
            <p><strong>Harga :</strong> RP {{ number_format($product->price, 0, ',', '.') }},00</p>
            <p><strong>Deskripsi :</strong> {{ $product->description }}</p>
            <!-- Tombol untuk Tambah ke Keranjang -->
            <form action="{{ route('cart.add', $product->id) }}" method="POST" class="mt-2">
                @csrf
                <button type="submit" class="btn btn-secondary">Tambahkan ke Keranjang</button>
            </form>
        </div>
    </div>
</div>
@endsection
