@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="card border-0 shadow-sm rounded-4 p-4" style="background: linear-gradient(135deg, #4f46e5 0%, #6366f1 100%); color: white;">
                <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
                    <div>
                        <span class="badge bg-white text-primary shadow-sm px-3 py-2 rounded-pill mb-2 fw-bold">👋 Selamat Datang Kembali!</span>
                        <h1 class="fw-bold mb-1">Halo, {{ Auth::user()->name }}!</h1>
                        <p class="mb-0 opacity-75">Sistem Pemesanan Tiket KAISimple siap melayani navigasi dan perjalanan Anda hari ini.</p>
                    </div>
                    <div class="bg-white bg-opacity-10 p-3 rounded-4 fs-1 d-none d-sm-block">
                        🚄
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-4 p-4 h-100 bg-white">
                <h4 class="fw-bold text-dark mb-3">Tentang KAISimple</h4>
                <p class="text-muted leading-relaxed">
                    <strong>KAISimple</strong> adalah platform pemesanan tiket kereta api berbasis web yang dikembangkan dengan focus pada kemudahan penggunaan (<em>user experience</em>) dan efisiensi manajemen data. Sistem ini mengintegrasikan peran <strong>Admin</strong> dan <strong>Penumpang</strong> ke dalam satu ekosistem yang terpadu.
                </p>
                <p class="text-muted leading-relaxed">
                    Aplikasi ini dirancang menggunakan arsitektur MVC (<em>Model-View-Controller</em>) melalui Framework Laravel untuk menjamin keamanan data transaksi, kecepatan pemrosesan jadwal rute, serta transparansi riwayat pesanan tiket secara berkala.
                </p>

                <hr class="my-4 text-light">

                <h5 class="fw-bold text-dark mb-3">Fitur Utama Akun Penumpang</h5>
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="p-3 border rounded-3 bg-light">
                            <div class="text-primary fs-4 mb-2">🔍</div>
                            <h6 class="fw-bold text-dark mb-1">Pencarian & Reservasi</h6>
                            <small class="text-muted">Cari jadwal kereta yang tersedia secara real-time dan pesan tiket secara instan.</small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="p-3 border rounded-3 bg-light">
                            <div class="text-indigo fs-4 mb-2">💳</div>
                            <h6 class="fw-bold text-dark mb-1">Manajemen Transaksi</h6>
                            <small class="text-muted">Pantau status pembayaran, update kuantitas tiket, dan simpan bukti riwayat pesanan.</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card border-0 shadow-sm rounded-4 p-4 h-100 bg-white">
                <h5 class="fw-bold text-dark mb-3">Informasi Akun Anda</h5>
                
                <ul class="list-group list-group-flush">
                    <li class="list-group-item px-0 py-3 bg-transparent d-flex justify-content-between align-items-center">
                        <div>
                            <span class="text-muted d-block small">Nama Pengguna</span>
                            <span class="fw-bold text-dark">{{ Auth::user()->name }}</span>
                        </div>
                        <span class="fs-5">👤</span>
                    </li>
                    <li class="list-group-item px-0 py-3 bg-transparent d-flex justify-content-between align-items-center">
                        <div>
                            <span class="text-muted d-block small">Alamat Email</span>
                            <span class="fw-bold text-dark">{{ Auth::user()->email }}</span>
                        </div>
                        <span class="fs-5">📧</span>
                    </li>
                    <li class="list-group-item px-0 py-3 bg-transparent d-flex justify-content-between align-items-center">
                        <div>
                            <span class="text-muted d-block small">Hak Akses Sistem</span>
                            <span class="badge bg-success bg-opacity-10 text-success text-capitalize border border-success border-opacity-20 px-3 py-2 rounded-pill">{{ Auth::user()->role }}</span>
                        </div>
                        <span class="fs-5">🔑</span>
                    </li>
                </ul>

                <div class="mt-4 p-3 rounded-3 text-center" style="background-color: #f0fdf4; border: 1px dashed #bbf7d0;">
                    <small class="text-success fw-medium d-block">Aplikasi Siap Digunakan ✅</small>
                    <small class="text-muted xsmall">Silakan pilih menu di atas untuk memulai aktivitas.</small>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection