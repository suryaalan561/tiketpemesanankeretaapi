@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card border-0 shadow-sm p-4 bg-white rounded">
                <h4 class="fw-bold text-primary mb-4">➕ Tambah Stasiun Baru</h4>

                <form action="{{ route('stasiun.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Kode Stasiun</label>
                        <input type="text" name="kode_stasiun" class="form-control" placeholder="Contoh: GMR, BDG" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Nama Stasiun</label>
                        <input type="text" name="nama_stasiun" class="form-control" placeholder="Contoh: Gambir" required>
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-semibold">Kota</label>
                        <input type="text" name="kota" class="form-control" placeholder="Contoh: Jakarta" required>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('stasiun.index') }}" class="btn btn-secondary">Kembali</a>
                        <button type="submit" class="btn btn-primary fw-bold">Simpan Stasiun</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection