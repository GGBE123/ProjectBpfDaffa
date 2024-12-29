@extends(Auth::check() ? 'layouts.user_type.auth' : 'layouts.user_type.guest')
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
    <div class="container">
        <h1>Tentang  Kami/h1>
        <p>-</p>

        <h3>Misi Kami/h3>
        <p>-</p>

        <h3>Nilai Kami</h3>
        <ul>
            <li>-</li>
            <li>-</li>
            <li>-</li>
        </ul>
    </div>
@endsection
