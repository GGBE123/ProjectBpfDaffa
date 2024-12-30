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
        <h1>Kontak Kami</h1>
        <p>Jika ada pertanyaan dianjurkan untuk mengontak kami melalui jalur berikut :</p>

        <h3>Lokasi Kami</h3>
        <div class="map-container">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3989.6419786255265!2d101.41859097496474!3d0.5386915994560418!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31d5ab0c825a72b3%3A0x8c515676b0850190!2sCV%20SIGASU%20JAYA%20Cab.%20RIAU!5e0!3m2!1sen!2sid!4v1735465541584!5m2!1sen!2sid" 
            width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>

        <h3>Informasi Kontak</h3>
        <p>
            <strong>Email :</strong>
            <a href="mailto:adroid.aya14@gmail.com">support@contoh.com</a>
        </p>
        <p>
            <strong>Handphone :</strong>
            <a href="tel:+6282172641576">(+62) 821-7264-1576</a>
        </p>
    </div>
@endsection
