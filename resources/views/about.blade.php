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
    <h1>Tentang Kami</h1>
    <p>Kami adalah perusahaan yang berfokus pada penjualan alat ternak ayam untuk peternak ayam broiler di daerah Riau. Dengan tujuan untuk membantu peternak meningkatkan produktivitas dan efisiensi, kami menyediakan berbagai produk berkualitas tinggi yang dirancang khusus untuk memenuhi kebutuhan industri peternakan ayam broiler.</p>

    <h3>Misi Kami</h3>
    <p>Misi kami adalah untuk mendukung peternak ayam broiler di Riau dengan menyediakan alat ternak terbaik yang dapat meningkatkan kesejahteraan hewan dan hasil produksi. Kami berkomitmen untuk memberikan solusi inovatif yang dapat membantu peternak mencapai keberhasilan dalam usaha mereka.</p>

    <h3>Nilai Kami</h3>
    <ul>
        <li>Integritas : Kami menjunjung tinggi kejujuran dan transparansi dalam setiap tindakan kami.</li>
        <li>Inovasi : Kami selalu mencari cara baru untuk meningkatkan produk dan layanan kami untuk mendukung peternak.</li>
        <li>Keberlanjutan : +Kami berkomitmen untuk melindungi lingkungan dan mendukung praktik peternakan yang berkelanjutan.</li>
    </ul>
</div>

@endsection
