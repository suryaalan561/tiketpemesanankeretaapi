<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PemesananController;
use App\Http\Controllers\StasiunController;
use App\Http\Controllers\KeretaController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\LaporanController;
use Illuminate\Support\Facades\Auth;

// Halaman Awal & Login Manual (Tanpa Install Package Lain)
Route::get('/', function () { 
    return view('auth.login'); 
})->name('login');

// RUTE BARU: Menampilkan Form Pendaftaran Penumpang
Route::get('/register', function () {
    return view('auth.register');
})->name('register');

// RUTE BARU: Memproses Simpan Data Pendaftaran ke Database
Route::post('/register', function (\Illuminate\Http\Request $request) {
    // Validasi data input dari form
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'telepon' => 'required|string|max:20',
        'password' => 'required|string|min:6|confirmed',
    ], [
        'email.unique' => 'Email ini sudah terdaftar di sistem.',
        'password.confirmed' => 'Konfirmasi password tidak cocok.',
        'password.min' => 'Password minimal harus 6 karakter.'
    ]);

    // Menyimpan data baru ke tabel 'users' di database
    \App\Models\User::create([
        'name' => $request->name,
        'email' => $request->email,
        'telepon' => $request->telepon, // Mendukung nomor telepon sesuai halaman profil
        'password' => \Illuminate\Support\Facades\Hash::make($request->password), // Enkripsi password keamanan
        'role' => 'penumpang', // Langsung dikunci sebagai hak akses penumpang
    ]);

    return redirect('/')->with('success', 'Akun berhasil dibuat! Silakan masuk sistem.');
});

Route::post('/login', function (\Illuminate\Http\Request $request) {
    $credentials = $request->only('email', 'password');
    if (Auth::attempt($credentials)) {
        // Jika admin diarahkan ke kelola jadwal, jika penumpang ke pencarian tiket
        return Auth::user()->role == 'admin' ? redirect('/admin/jadwal') : redirect('/cari-tiket');
    }
    return back()->withErrors(['email' => 'Email atau password salah.']);
});

Route::post('/logout', function () {
    Auth::logout();
    return redirect('/');
})->name('logout');


// Group Route yang Harus Login Dahulu
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/laporan-pendapatan', [LaporanController::class, 'index'])->name('laporan.index');
    
    // Fitur Bersama (Bisa diakses Admin & Penumpang)
    Route::get('/riwayat', [PemesananController::class, 'riwayat'])->name('pesanan.riwayat');
    
    // 🌟 PERUBAHAN DI SINI: Mengubah pembayaran lama dari POST menjadi GET ke halaman QR Code
    Route::get('/pesanan/bayar/{id}', [PemesananController::class, 'halamanBayar'])->name('pesanan.bayar');
    
    // 🌟 SISIPAN BARU: Rute untuk memproses tombol "Selesai" (mengubah status menjadi lunas)
    Route::post('/pesanan/konfirmasi-bayar/{id}', [PemesananController::class, 'prosesBayar'])->name('pesanan.konfirmasi-bayar');
    
    // ROUTE BARU: Update Jumlah Tiket (Tambah/Kurang) Before Dibayar
    Route::post('/pesanan/update/{id}', [PemesananController::class, 'updateTiket'])->name('pesanan.update');

    // Rute Membatalkan & Mencetak Bukti Tiket Kereta Api
    Route::post('/pesanan/batal/{id}', [PemesananController::class, 'batalkanPesanan'])->name('pesanan.batal');
    Route::get('/pesanan/cetak/{id}', [PemesananController::class, 'cetakTiket'])->name('pesanan.cetak');

    // ROUTE KHUSUS ADMIN (CRUD Menu)
    Route::middleware(['role:admin'])->prefix('admin')->group(function () {
        // resource ini sudah otomatis menghandle rute index, create, store, show, edit, update, dan destroy
        Route::resource('stasiun', StasiunController::class);
        Route::resource('kereta', KeretaController::class);
        Route::resource('jadwal', JadwalController::class);
    });

    // ROUTE KHUSUS PENUMPANG
    Route::middleware(['role:penumpang'])->group(function () {
        // ROUTE BARU: Halaman Utama Dashboard Penumpang
        Route::get('/dashboard', function () {
            return view('penumpang.dashboard');
        })->name('dashboard');

        Route::get('/cari-tiket', [PemesananController::class, 'indeksCari'])->name('tiket.cari');
        Route::post('/pesan-tiket/{jadwal_id}', [PemesananController::class, 'pesan'])->name('tiket.pesan');
        
        // Route Tambahan untuk Profil Saya
        Route::get('/profil', [App\Http\Controllers\ProfilController::class, 'indeks'])->name('profil.indeks');
        Route::post('/profil/update', [App\Http\Controllers\ProfilController::class, 'update'])->name('profil.update');
        
        // Route Pusat Bantuan & FAQ Penumpang
        Route::get('/pusat-bantuan', function () {
            return view('penumpang.bantuan');
        })->name('bantuan');

        // ROUTE BARU: Peta Jalur & Denah Stasiun
        Route::get('/peta-denah', function () {
            return view('penumpang.denah');
        })->name('peta.denah');
    });
});