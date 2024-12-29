@extends(Auth::check() ? 'layouts.user_type.auth' : 'layouts.user_type.guest')
<!-- Landing Page Section -->
@section('content')
@guest
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="{{ route('home') }}">Home</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('store.index') }}">Toko</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('about') }}">Tentang kami</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('contact') }}">Kontak</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('register') }}">Buat akun</a>
                </li>
            </ul>
        </div>
    </nav>
@endguest

<!-- Main Content: Introduction Section -->
<section class="intro-section text-center py-5">
    <h1 class="display-4">Selamat datang di toko kami!</h1>
    <p class="lead">Lihat katalog produk kami dengan mengunjungi halaman toko kami!</p>
    <div>
        <a href="{{ url('store') }}" class="btn btn-primary btn-lg">Halaman Toko</a>
        <a href="{{ url('about') }}" class="btn btn-secondary btn-lg">Tentang Kami</a>
        <a href="{{ url('contact') }}" class="btn btn-primary btn-lg">Kontak Kami</a>
    </div>
</section>
</div>
@endsection
