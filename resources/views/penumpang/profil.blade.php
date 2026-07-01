@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card border-0 shadow-sm p-4 bg-white rounded-4">
                <div class="mb-4 text-center">
                    <h4 class="fw-bold text-primary m-0">👤 Profil Saya</h4>
                    <p class="text-muted small">Perbarui informasi akun Anda di bawah ini</p>
                </div>

                @if(session('success'))
                    <div class="alert alert-success border-0 shadow-sm mb-3 text-center fw-medium">
                        🎉 {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('profil.update') }}" method="POST">
                    @csrf
                    
                    <div class="mb-3">
                        <label for="name" class="form-label fw-semibold text-secondary">Nama Lengkap</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $user->name) }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label fw-semibold text-secondary">Alamat Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="no_telp" class="form-label fw-semibold text-secondary">Nomor Telepon</label>
                        <input type="text" class="form-control @error('no_telp') is-invalid @enderror" id="no_telp" name="no_telp" value="{{ old('no_telp', $user->no_telp) }}" placeholder="Contoh: 08123456789">
                        @error('no_telp')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary fw-bold py-2">Simpan Perubahan</button>
                        <a href="{{ route('tiket.cari') }}" class="btn btn-outline-secondary py-2">Kembali ke Cari Tiket</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection