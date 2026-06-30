@extends('layouts.app')

@section('content')
<div class="container">
    
    <div class="card p-4 shadow-sm border-0 mb-4 bg-white rounded">
        <h4 class="mb-3 text-primary fw-bold">🚂 Mau Pergi ke Mana?</h4>
        <form action="{{ route('tiket.cari') }}" method="GET">
            <div class="row g-3 align-items-end">
                
                <div class="col-md-5">
                    <label class="form-label small fw-bold text-muted">Stasiun Asal</label>
                    <select name="asal" class="form-select">
                        <option value="">-- Semua Stasiun Asal --</option>
                        @foreach($stasiuns as $s) 
                            <option value="{{ $s->id }}" {{ request('asal') == $s->id ? 'selected' : '' }}>
                                {{ $s->nama_stasiun }} ({{ $s->kode_stasiun }}) - {{ $s->kota }}
                            </option> 
                        @endforeach
                    </select>
                </div>

                <div class="col-md-5">
                    <label class="form-label small fw-bold text-muted">Stasiun Tujuan</label>
                    <select name="tujuan" class="form-select">
                        <option value="">-- Semua Stasiun Tujuan --</option>
                        @foreach($stasiuns as $s) 
                            <option value="{{ $s->id }}" {{ request('tujuan') == $s->id ? 'selected' : '' }}>
                                {{ $s->nama_stasiun }} ({{ $s->kode_stasiun }}) - {{ $s->kota }}
                            </option> 
                        @endforeach
                    </select>
                </div>

                <div class="col-md-2">
                    <button type="submit" class="btn btn-warning w-100 fw-bold shadow-sm text-dark">Cari</button>
                </div>
            </div>
            
            @if(request()->anyFilled(['asal', 'tujuan']))
                <div class="mt-2 text-end">
                    <a href="{{ route('tiket.cari') }}" class="btn btn-sm btn-light border fw-semibold">❌ Bersihkan Filter Pencarian</a>
                </div>
            @endif
        </form>
    </div>

    <h5 class="mb-3 fw-bold text-secondary">
        {{ request()->anyFilled(['asal', 'tujuan']) ? '🔍 Hasil Pencarian Jadwal Kereta' : '📅 JADWAL TIKET YANG TERSEDIA' }}
    </h5>
    
    @if($jadwals && $jadwals->count() > 0)
        <div class="row">
            @foreach($jadwals as $j)
                <div class="col-md-12 mb-3">
                    <div class="card shadow-sm border-0 p-3">
                        <div class="row align-items-center">
                            
                            <div class="col-md-3">
                                <h5 class="fw-bold m-0 text-primary">{{ $j->kereta->nama_kereta }}</h5>
                                <span class="badge bg-primary-subtle text-primary small mt-1">{{ $j->kereta->kelas }}</span>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <span class="fw-bold d-block text-dark">{{ \Carbon\Carbon::parse($j->waktu_berangkat)->format('H:i') }}</span>
                                        <span class="badge bg-light text-dark border">{{ $j->stasiunAsal->kode_stasiun }}</span>
                                    </div>
                                    <div class="text-muted small text-center">
                                        <div style="font-size: 11px;">{{ \Carbon\Carbon::parse($j->waktu_berangkat)->format('d M Y') }}</div>
                                        <div>➡️</div>
                                    </div>
                                    <div>
                                        <span class="fw-bold d-block text-dark">{{ \Carbon\Carbon::parse($j->waktu_tiba)->format('H:i') }}</span>
                                        <span class="badge bg-light text-dark border">{{ $j->stasiunTujuan->kode_stasiun }}</span>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-3 text-end">
                                <span class="text-muted small d-block">Harga Tiket</span>
                                <h5 class="fw-bold text-danger m-0">Rp {{ number_format($j->harga_tiket, 0, ',', '.') }}</h5>
                                <small class="text-muted text-xs">/ orang</small>
                            </div>
                            
                            <div class="col-md-2 text-end">
                                <form action="{{ route('tiket.pesan', $j->id) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="jumlah_tiket" value="1">
                                    <button type="submit" class="btn btn-success fw-bold w-100 shadow-sm">Pesan Sekarang</button>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="alert alert-light text-center border p-4 shadow-sm rounded">
            😔 Maaf, tidak ada jadwal kereta yang cocok atau tersedia saat ini.
        </div>
    @endif

</div>
@endsection