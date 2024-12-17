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
                    <a class="nav-link" href="{{ route('store.index') }}">Store</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('about') }}">About Us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('contact') }}">Contact</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">Sign In</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('register') }}">Sign Up</a>
                </li>
            </ul>
        </div>
    </nav>
@endguest

<!-- Main Content: Introduction Section -->
<section class="intro-section text-center py-5">
    <h1 class="display-4">Welcome to Our Store!</h1>
    <p class="lead">Discover amazing products and services tailored just for you. Explore our platform and get to know
        us better.</p>
    <div>
        <a href="{{ url('about') }}" class="btn btn-primary btn-lg">Learn More About Us</a>
        <a href="{{ url('store') }}" class="btn btn-secondary btn-lg">Browse Our Store</a>
    </div>
</section>
</div>
@endsection
