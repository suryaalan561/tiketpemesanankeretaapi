@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-0 shadow-sm p-4 bg-white rounded">
                <h4 class="fw-bold text-primary mb-4">➕ Tambah Jadwal Rute Kereta Baru</h4>

                <form action="{{ route('jadwal.store') }}" method="POST">
                    @csrf
                    
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Pilih Kereta</label>
                        <select class="form-select" name="kereta_id" required>
                            @foreach($keretas as $k)
                                <option value="{{ $k->id }}">{{ $k->nama_kereta }} ({{ $k->kelas }})</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Stasiun Asal</label>
                            <select class="form-select" name="stasiun_asal_id" required>
                                @foreach($stasiuns as $s)
                                    <option value="{{ $s->id }}">{{ $s->nama_stasiun }} ({{ $s->kode_stasiun }})</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Stasiun Tujuan</label>
                            <select class="form-select" name="stasiun_tujuan_id" required>
                                @foreach($stasiuns as $s)
                                    <option value="{{ $s->id }}">{{ $s->nama_stasiun }} ({{ $s->kode_stasiun }})</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Waktu Berangkat</label>
                            <input type="datetime-local" name="waktu_berangkat" class="form-control" required>
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Waktu Tiba</label>
                            <input type="datetime-local" name="waktu_tiba" class="form-control" required>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold">Harga Tiket (Rupiah)</label>
                        <input type="number" name="harga_tiket" class="form-control" placeholder="Contoh: 150000" required>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('jadwal.index') }}" class="btn btn-secondary">Kembali</a>
                        <button type="submit" class="btn btn-primary fw-bold">Simpan Jadwal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection