@extends('layouts.user_type.auth')

@section('content')
<div class="container">
    <h1>Pembayaran Transfer Bank</h1>
    <div class="text-end">
        <h4>Total : RP {{ number_format($checkoutData['total'], 0, ',', '.') }},00</h4>
    </div>
    <p>Silakan lakukan pembayaran melalui transfer bank ke rekening berikut:</p>
    <ul>
        <li><strong>Bank :</strong> Bank BCA/li>
        <li><strong>Nomor Rekening :</strong> 8924242034</li>
        <li><strong>Nama Rekening :</strong> Contoh</li>
    </ul>
    <p>Setelah melakukan transfer, silakan konfirmasi pembayaran melalui kontak kami. Setelah itu silahkan cek halaman order anda, statusnya akan diubah setelah kami mendapatkan konfirmasi pembayaran.</p>
    <div class="text-end">
        <a href="{{ route('store.index') }}" class="btn btn-primary">Kembali ke Toko</a>
    </div>
</div>
@endsection
