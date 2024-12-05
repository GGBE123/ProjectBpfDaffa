@extends('layouts.user_type.auth')

@section('content')
<!-- Hero Section -->
<div class="container-fluid">
    <div class="page-header min-height-300 border-radius-xl mt-4" style="background-image: url('../assets/img/curved-images/curved0.jpg'); background-position-y: 50%;">
        <span class="mask bg-gradient-primary opacity-6"></span>
    </div>
</div>

<!-- Card Section (Website Info) -->
<div class="card card-body blur shadow-blur mx-4 mt-n6">
    <div class="row gx-4">
        <!-- Product Catalog Introduction -->
        <div class="col-auto">
            <div class="avatar avatar-xl position-relative">
                <img src="../assets/img/ayam.jpg" alt="Product Image" class="w-100 border-radius-lg shadow-sm">
                <a href="javascript:;" class="btn btn-sm btn-icon-only bg-gradient-light position-absolute bottom-0 end-0 mb-n2 me-n2">
                    <i class="fa fa-pen top-0" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Image"></i>
                </a>
            </div>
        </div>
        <div class="col-auto my-auto">
            <div class="h-100">
                <h5 class="mb-1">{{ __('Website Katalog dan Penjualan Alat Ternak Ayam') }}</h5>
                <p class="mb-0 font-weight-bold text-sm">{{ __('Tempat untuk menemukan berbagai alat ternak ayam dengan mudah') }}</p>
            </div>
        </div>
    </div>
</div>

<!-- Call to Action Section -->
<div class="row mt-4">
    <div class="col-md-6 mx-auto text-center">
        <h2 class="display-3">{{ __('Selamat datang di Website Katalog dan Penjualan Alat Ternak Ayam!') }}</h2>
        <p class="lead">{{ __('Temukan berbagai alat ternak ayam dengan harga terbaik dan kemudahan pembelian secara langsung.') }}</p>
        <a href="#contact" class="btn btn-primary btn-lg">{{ __('Hubungi Kami') }}</a>
    </div>
</div>

<!-- Product Catalog Section -->
<div class="row mt-5">
    <div class="col-md-4 text-center">
        <div class="card">
            <img src="../assets/img/produk1.jpg" class="card-img-top" alt="Alat Ternak 1">
            <div class="card-body">
                <h5 class="card-title">{{ __('Alat Ternak Ayam 1') }}</h5>
                <p class="card-text">{{ __('Deskripsi singkat tentang produk ini dengan harga dan fitur.') }}</p>
                <a href="#" class="btn btn-primary">{{ __('Beli Sekarang') }}</a>
            </div>
        </div>
    </div>

    <div class="col-md-4 text-center">
        <div class="card">
            <img src="../assets/img/produk2.jpg" class="card-img-top" alt="Alat Ternak 2">
            <div class="card-body">
                <h5 class="card-title">{{ __('Alat Ternak Ayam 2') }}</h5>
                <p class="card-text">{{ __('Deskripsi singkat tentang produk ini dengan harga dan fitur.') }}</p>
                <a href="#" class="btn btn-primary">{{ __('Beli Sekarang') }}</a>
            </div>
        </div>
    </div>

    <div class="col-md-4 text-center">
        <div class="card">
            <img src="../assets/img/produk3.jpg" class="card-img-top" alt="Alat Ternak 3">
            <div class="card-body">
                <h5 class="card-title">{{ __('Alat Ternak Ayam 3') }}</h5>
                <p class="card-text">{{ __('Deskripsi singkat tentang produk ini dengan harga dan fitur.') }}</p>
                <a href="#" class="btn btn-primary">{{ __('Beli Sekarang') }}</a>
            </div>
        </div>
    </div>
</div>

<!-- Contact Section -->
<div id="contact" class="row mt-5">
    <div class="col-md-8 mx-auto text-center">
        <h3>{{ __('Hubungi Kami') }}</h3>
        <p>{{ __('Kami siap membantu Anda dengan pertanyaan atau masukan seputar alat ternak ayam yang kami jual.') }}</p>
        <form>
            <input type="text" class="form-control mb-2" placeholder="Nama Anda" required>
            <input type="email" class="form-control mb-2" placeholder="Email Anda" required>
            <textarea class="form-control mb-2" placeholder="Pesan Anda" rows="4" required></textarea>
            <button type="submit" class="btn btn-primary">{{ __('Kirim Pesan') }}</button>
        </form>
    </div>
</div>
@endsection
