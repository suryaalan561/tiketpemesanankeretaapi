@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card border-0 shadow-sm p-4 bg-white rounded">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="fw-bold text-primary m-0">📋 Riwayat & Daftar Pesanan Tiket</h4>
            <span class="badge bg-secondary">Mode: {{ ucfirst(Auth::user()->role) }}</span>
        </div>

        @if(session('success'))
            <div class="alert alert-success border-0 shadow-sm mb-3">
                🎉 {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger border-0 shadow-sm mb-3">
                ❌ {{ session('error') }}
            </div>
        @endif

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-primary text-white">
                    <tr>
                        <th>Kode Booking</th>
                        @if(Auth::user()->role == 'admin')
                            <th>Nama Penumpang</th>
                        @endif
                        <th>Kereta & Kelas</th>
                        <th>Rute Perjalanan</th>
                        <th>Jumlah & Total Harga</th>
                        <th>Status</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pesanans as $p)
                        <tr>
                            <td><strong class="text-monospace text-success">{{ $p->kode_booking }}</strong></td>
                            @if(Auth::user()->role == 'admin')
                                <td>{{ $p->user->name }}</td>
                            @endif
                            <td>
                                <span class="fw-bold d-block">{{ $p->jadwal->kereta->nama_kereta }}</span>
                                <small class="text-muted">{{ $p->jadwal->kereta->kelas }}</small>
                            </td>
                            <td>
                                <span class="d-block"><strong>{{ $p->jadwal->stasiunAsal->nama_stasiun }}</strong> ➡️ <strong>{{ $p->jadwal->stasiunTujuan->nama_stasiun }}</strong></span>
                                <small class="text-muted">{{ \Carbon\Carbon::parse($p->jadwal->waktu_berangkat)->format('d M Y, H:i') }}</small>
                            </td>
                            <td>
                                @if($p->status_pembayaran == 'belum_bayar')
                                    <div class="d-flex align-items-center gap-2 mb-1">
                                        <form action="{{ route('pesanan.update', $p->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            <input type="hidden" name="aksi" value="kurang">
                                            <button type="submit" class="btn btn-sm btn-outline-secondary py-0 px-2 fw-bold" {{ $p->jumlah_tiket <= 1 ? 'disabled' : '' }}>-</button>
                                        </form>

                                        <span class="fw-bold bg-light px-2 py-1 border rounded" style="min-width: 30px; text-align: center;">
                                            {{ $p->jumlah_tiket }} Tiket
                                        </span>

                                        <form action="{{ route('pesanan.update', $p->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            <input type="hidden" name="aksi" value="tambah">
                                            <button type="submit" class="btn btn-sm btn-outline-secondary py-0 px-2 fw-bold">+</button>
                                        </form>
                                    </div>
                                @else
                                    <span class="d-block fw-semibold text-muted">{{ $p->jumlah_tiket }} Tiket</span>
                                @endif

                                <div class="fw-bold text-dark">Rp {{ number_format($p->total_harga, 0, ',', '.') }}</div>
                            </td>
                            
                            <td>
                                @if($p->status_pembayaran == 'lunas')
                                    <span class="badge bg-success py-2 px-3">Lunas</span>
                                @elseif($p->status_pembayaran == 'batal')
                                    <span class="badge bg-danger py-2 px-3">Dibatalkan</span>
                                @else
                                    <span class="badge bg-warning text-dark py-2 px-3">Belum Bayar</span>
                                @endif
                            </td>

                            <td class="text-center">
                                @if($p->status_pembayaran == 'belum_bayar')
                                    {{-- Penyesuaian Tombol Sesuai Request Anda --}}
                                    @if(Auth::user()->role == 'admin')
                                        <form action="{{ route('pesanan.konfirmasi-bayar', $p->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-sm mb-1 w-100 btn-success">Konfirmasi Bayar (Admin)</button>
                                        </form>
                                    @else
                                        <a href="{{ route('pesanan.bayar', $p->id) }}" class="btn btn-sm mb-1 w-100 btn-warning fw-bold text-dark">
                                            Bayar Sekarang
                                        </a>
                                    @endif

                                    <form action="{{ route('pesanan.batal', $p->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin membatalkan pesanan tiket ini?')">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-outline-danger fw-bold w-100 mt-1">Batalkan Pesanan</button>
                                    </form>
                                @elseif($p->status_pembayaran == 'lunas')
                                    <a href="{{ route('pesanan.cetak', $p->id) }}" target="_blank" class="btn btn-sm btn-primary fw-bold w-100 mb-1">🎟️ Lihat Tiket</a>
                                    
                                    <div class="mt-1">
                                        <span class="badge bg-light text-secondary border text-wrap p-2" style="font-size: 11px; max-width: 180px; text-align: left; display: inline-block; line-height: 1.4;">
                                            ℹ️ Pembatalan & refund dana hanya bisa dilakukan offline di loket stasiun utama.
                                        </span>
                                    </div>
                                @else
                                    <button class="btn btn-sm btn-secondary" disabled>Dibatalkan</button>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="{{ Auth::user()->role == 'admin' ? '7' : '6' }}" class="text-center text-muted py-4">
                                Belum ada riwayat pemesanan tiket kereta.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection