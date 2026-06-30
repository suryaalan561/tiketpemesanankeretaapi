@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card border-0 shadow-sm p-4 bg-white rounded">
                <h4 class="fw-bold text-primary mb-4">➕ Tambah Kereta Baru</h4>

                <form action="{{ route('kereta.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Nama Kereta</label>
                        <input type="text" name="nama_kereta" class="form-control" placeholder="Contoh: Argo Lawu, Matarmaja" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Kelas Kereta</label>
                        <select name="kelas" class="form-select" required>
                            <option value="Eksekutif">Eksekutif</option>
                            <option value="Bisnis">Bisnis</option>
                            <option value="Ekonomi">Ekonomi</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-semibold">Total Kapasitas Kursi</label>
                        <input type="number" name="total_kursi" class="form-control" placeholder="Contoh: 50" min="1" required>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('kereta.index') }}" class="btn btn-secondary">Kembali</a>
                        <button type="submit" class="btn btn-primary fw-bold">Simpan Kereta</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection