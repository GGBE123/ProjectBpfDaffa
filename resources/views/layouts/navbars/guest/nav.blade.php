<!-- Guest Navbar -->
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
  <div class="container-fluid py-1 px-3">
      <!-- Space between page title and Store link -->
      <div class="my-2"></div>

      <!-- Store Link -->
      <div class="nav-item">
          <a href="{{ route('store.index') }}" class="btn btn-primary mb-0 text-white" role="button">
              Pergi ke Toko
          </a>
      </div>

      <!-- Collapse the Navbar Links -->
      <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4 d-flex justify-content-end" id="navbar">
          <ul class="navbar-nav justify-content-end">
              
              <!-- About Us Link -->
              <li class="nav-item">
                  <a class="nav-link text-body font-weight-bold px-0" href="{{ url('about') }}">
                      <i class="fas fa-info-circle me-sm-1"></i> Tentang Kami
                  </a>
              </li>

              <!-- Store Link -->
              <li class="nav-item">
                  <a class="nav-link text-body font-weight-bold px-0" href="{{ route('store.index') }}">
                      <i class="fas fa-store me-sm-1"></i> Toko
                  </a>
              </li>
              
              <!-- Contact Link -->
              <li class="nav-item">
                  <a class="nav-link text-body font-weight-bold px-0" href="{{ url('contact') }}">
                      <i class="fas fa-phone me-sm-1"></i> Kontak
                  </a>
              </li>

              <!-- Sign Up Link -->
              <li class="nav-item">
                  <a class="nav-link text-body font-weight-bold px-0" href="{{ url('register') }}">
                      <i class="fas fa-user-circle me-sm-1"></i> Buat akun
                  </a>
              </li>

              <!-- Sign In Link -->
              <li class="nav-item">
                  <a class="nav-link text-body font-weight-bold px-0" href="{{ url('login') }}">
                      <i class="fas fa-key me-sm-1"></i> Login
                  </a>
              </li>

          </ul>
      </div>
  </div>
</nav>
<!-- End Navbar -->
