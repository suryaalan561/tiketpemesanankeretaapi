<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Pemesanan Tiket KAI</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #f8fafc; /* Warna background abu-abu super soft */
            color: #334155;
        }
        .navbar {
            background-color: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px); /* Efek blur premium pada navbar */
        }
        .nav-link {
            font-weight: 600;
            color: #64748b !important;
            transition: all 0.2s ease;
            padding: 0.5rem 1rem !important;
            border-radius: 20px; /* Bentuk pil melengkung halus */
        }
        .nav-link:hover {
            color: #4f46e5 !important; /* Warna indigo modern saat hover */
            background-color: #f1f5f9;
        }
        /* Style khusus agar menu yang aktif menyala */
        .nav-link.active-menu {
            color: #4f46e5 !important;
            background-color: #e0e7ff !important; /* Latar belakang biru muda transparan */
        }
        .navbar-brand {
            font-size: 1.25rem;
            letter-spacing: -0.5px;
        }
        .dropdown-menu {
            border: none;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.05), 0 4px 6px -4px rgba(0, 0, 0, 0.05);
            border-radius: 12px;
            padding: 0.5rem;
        }
        .dropdown-item {
            border-radius: 8px;
            padding: 0.5rem 1rem;
            font-weight: 500;
            color: #475569;
        }
        .dropdown-item:hover {
            background-color: #f1f5f9;
            color: #4f46e5;
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-light border-bottom border-light sticky-top shadow-sm mb-5 py-3">
      <div class="container">
        <a class="navbar-brand fw-extrabold text-primary me-4" href="#">
            <span class="me-1">🚂</span> KAI<span class="text-dark">Simple</span>
        </a>
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
          <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav me-auto gap-2">
            @if(Auth::check() && Auth::user()->role == 'admin')
              <li class="nav-item">
                <a class="nav-link {{ Route::is('stasiun.*') ? 'active-menu' : '' }}" href="{{ route('stasiun.index') }}">Stasiun</a>
                </li>
              <li class="nav-item">
                <a class="nav-link {{ Route::is('kereta.*') ? 'active-menu' : '' }}" href="{{ route('kereta.index') }}">Kereta</a>
              </li>
              <li class="nav-item">
                <a class="nav-link {{ Route::is('jadwal.*') ? 'active-menu' : '' }}" href="{{ route('jadwal.index') }}">Jadwal Rute</a>
              </li>
              <li class="nav-item">
                <a class="nav-link {{ Request::routeIs('laporan.index') ? 'active-menu' : '' }}" href="{{ route('laporan.index') }}">Laporan Pendapatan</a>
              </li>
            @elseif(Auth::check() && Auth::user()->role == 'penumpang')
              <li class="nav-item">
                <a class="nav-link {{ Route::is('dashboard') ? 'active-menu' : '' }}" href="{{ route('dashboard') }}">Dashboard</a>
              </li>
              <li class="nav-item">
                <a class="nav-link {{ Route::is('tiket.cari') ? 'active-menu' : '' }}" href="{{ route('tiket.cari') }}">Cari Tiket</a>
              </li>
              <li class="nav-item">
                <a class="nav-link {{ Route::is('profil.indeks') ? 'active-menu' : '' }}" href="{{ route('profil.indeks') }}">Profil Saya</a>
              </li>
              <li class="nav-item">
                <a class="nav-link {{ Route::is('bantuan') ? 'active-menu' : '' }}" href="{{ route('bantuan') }}">Pusat Bantuan</a>
              </li>
              <li class="nav-item">
                <a class="nav-link {{ Route::is('peta.denah') ? 'active-menu' : '' }}" href="{{ route('peta.denah') }}">Denah Stasiun</a>
              </li>
            @endif
            
            @if(Auth::check())
              <li class="nav-item">
                <a class="nav-link {{ Route::is('pesanan.riwayat') ? 'active-menu' : '' }}" href="{{ route('pesanan.riwayat') }}">Riwayat Pesanan</a>
              </li>
            @endif
          </ul>
          
          @if(Auth::check())
            <div class="navbar-nav">
              <div class="nav-item dropdown">
                <a class="nav-link dropdown-toggle fw-bold text-dark d-flex align-items-center gap-2 bg-light px-3 py-2 border rounded-pill" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  <span>👤</span> {{ Auth::user()->name }}
                </a>
                <ul class="dropdown-menu dropdown-menu-end mt-2" aria-labelledby="navbarDropdown">
                  <li>
                    <div class="dropdown-header text-xs text-uppercase fw-bold text-muted px-3 pt-2">
                        Akses: {{ Auth::user()->role }}
                    </div>
                  </li>
                  @if(Auth::user()->role == 'penumpang')
                    <li><a class="dropdown-item" href="{{ route('profil.indeks') }}">Edit Profil</a></li>
                  @endif
                  <li><hr class="dropdown-divider text-light"></li>
                  <li>
                    <form action="{{ route('logout') }}" method="POST" class="m-0 p-0">
                        @csrf
                        <button type="submit" class="dropdown-item text-danger fw-semibold d-flex align-items-center justify-content-between">
                            Logout <span>➔</span>
                        </button>
                    </form>
                  </li>
                </ul>
              </div>
            </div>
          @endif
        </div>
      </div>
    </nav>

    <div class="container pb-5">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>