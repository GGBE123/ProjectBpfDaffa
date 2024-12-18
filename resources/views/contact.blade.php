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
    <div class="container">
        <h1>Contact Us</h1>
        <p>If you have any questions, feel free to reach out to us! We are here to help.</p>

        <h3>Our Office</h3>
        <!-- Google Maps Embed -->
        <div class="map-container">
            <iframe src="https://www.google.com/maps/embed?pb=YOUR_GOOGLE_MAPS_EMBED_URL"
                width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
        </div>

        <h3>Contact Information</h3>
        <p>
            <strong>Email:</strong>
            <a href="mailto:support@example.com">support@example.com</a>
        </p>
        <p>
            <strong>Phone:</strong>
            <a href="tel:+11234567890">(123) 456-7890</a>
        </p>
    </div>
@endsection
