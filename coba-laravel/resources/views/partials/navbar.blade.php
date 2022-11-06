<nav class="navbar navbar-expand-lg bg-primary navbar-dark">
    <div class="container">
      <a class="navbar-brand" href="/">Web Yazz</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link {{ ($active === "home" ? 'active' : '') }}" href="/">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ ($active === "about" ? 'active' : '') }}" href="/about">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ ($active === "posts" ? 'active' : '') }}" href="/posts">Blog</a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ ($active === "categories" ? 'active' : '') }}" href="/categories">Categories</a>
          </li>
        </ul>
        {{-- @auth, kalau kalian mau ngecek apakah user sudah login atau belum, kalau udh login tampilin apa, kalau belum tampilin apa --}}
        {{-- @guest, kalo guest tampilin apa, kalau auth tampilin apa --}}
        <ul class="navbar-nav ms-auto">
          @auth {{-- Jika user sudah login --}}
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Welcome back, {{ auth()->user()->name }} {{-- jadi ini akan mengambil data name dari table user ketika sudah menjalankan authentication/sudah login --}}
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="/dashboard"><i class="bi bi-bar-chart-line"></i> My Dashboard</a></li>
              <li><hr class="dropdown-divider"></li>
              <li>
                <form action="/logout" method="POST">
                  @csrf
                  <button type="submit" class="dropdown-item"><i class="bi bi-box-arrow-right"></i> Logout</button>
                </form>
              </li>
            </ul>
          </li>
          @else {{-- Jika user belum login --}}
          <li class="nav-item">
            <a href="/login" class="nav-link {{ $active === 'login' ? 'active' : '' }}"><i class="bi bi-person-circle"></i> Login</a>
          </li>
          @endauth
        </ul>
      </div>
    </div>
</nav>