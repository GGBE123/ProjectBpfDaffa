@extends('layouts.app')

@section('guest')
    @if(\Request::is('login/forgot-password')) 
        @include('layouts.navbars.guest.nav')
        @yield('content') 
    @else
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <!-- Use position-relative or just remove positioning classes -->
                    <div class="navbar-container">
                        {{-- @include('layouts.navbars.guest.nav') --}}
                    </div>
                </div>
            </div>
        </div>
        @yield('content')        
        @include('layouts.footers.guest.footer')
    @endif
@endsection
