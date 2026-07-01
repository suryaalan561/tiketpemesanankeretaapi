@extends('layouts.app')

@section('content')
<div class="d-flex align-items-center justify-content-center" style="min-height: 70vh;">
    <div class="card border-0 shadow-sm p-4 bg-white rounded" style="width: 100%; max-width: 450px;">
        <div class="text-center mb-4">
            <h4 class="fw-bold text-primary mb-1">🚂 KAI <span class="text-dark">Simple</span></h4>
            <small class="text-muted">Pendaftaran Akun Baru Penumpang</small>
        </div>

        @if($errors->any())
            <div class="alert alert-danger py-2 border-0 mb-3" style="font-size: 0.85rem;">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('register') }}" method="POST">
            @csrf
            
            <div class="mb-3">
                <label class="form-label small fw-bold text-secondary">Nama Lengkap</label>
                <input type="text" name="name" class="form-control focus-ring" placeholder="Masukkan nama lengkap Anda" required value="{{ old('name') }}">
            </div>

            <div class="mb-3">
                <label class="form-label small fw-bold text-secondary">Alamat Email</label>
                <input type="email" name="email" class="form-control" placeholder="contoh@email.com" required value="{{ old('email') }}">
            </div>

            <div class="mb-3">
                <label class="form-label small fw-bold text-secondary">Nomor Telepon</label>
                <input type="text" name="telepon" class="form-control" placeholder="Contoh: 08123322334" required value="{{ old('telepon') }}">
            </div>
            
            <div class="mb-3">
                <label class="form-label small fw-bold text-secondary">Password</label>
                <input type="password" name="password" class="form-control" placeholder="Minimal 6 karakter" required>
            </div>

            <div class="mb-4">
                <label class="form-label small fw-bold text-secondary">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" class="form-control" placeholder="Ulangi password Anda" required>
            </div>

            <button type="submit" class="btn btn-primary w-100 fw-bold py-2 rounded-pill mb-3">Daftar Sekarang</button>
            
            <div class="text-center">
                <small class="text-muted">Sudah punya akun? <a href="{{ route('login') }}" class="text-primary fw-bold text-decoration-none">Log In di sini</a></small>
            </div>
        </form>
    </div>
</div>
@endsection