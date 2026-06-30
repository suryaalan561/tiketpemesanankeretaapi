@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-md-6 mb-3 mb-md-0">
            <div class="card border-0 shadow-sm p-4 bg-white rounded h-100" style="border-left: 5px solid #198754 !important;">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <h6 class="text-muted fw-bold text-uppercase mb-2" style="font-size: 0.85rem; letter-spacing: 0.5px;">🎟️ Total Tiket Terjual</h6>
                        <h2 class="fw-extrabold text-success m-0">{{ $totalTiketTerjual }} <span class="fs-5 text-muted fw-normal">Tiket</span></h2>
                    </div>
                    <div class="bg-success bg-opacity-10 p-3 rounded-circle text-success fs-3">
                        📊
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card border-0 shadow-sm p-4 bg-white rounded h-100" style="border-left: 5px solid #ffc107 !important;">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <h6 class="text-muted fw-bold text-uppercase mb-2" style="font-size: 0.85rem; letter-spacing: 0.5px;">💰 Total Pendapatan</h6>
                        <h2 class="fw-extrabold text-warning m-0">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</h2>
                    </div>
                    <div class="bg-warning bg-opacity-10 p-3 rounded-circle text-warning fs-3">
                        💳
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm p-4 bg-white rounded mb-4">
        <h5 class="fw-bold text-secondary mb-3">📈 Penjelasan Pendapatan Per Tanggal</h5>
        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Tanggal Pembayaran</th>
                        <th class="text-center">Tiket Terjual</th>
                        <th class="text-end">Total Pendapatan Harian</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pendapatanPerTanggal as $ppt)
                        <tr>
                            <td><strong>{{ \Carbon\Carbon::parse($ppt->tanggal)->format('d M Y') }}</strong></td>
                            <td class="text-center">{{ $ppt->total_tiket }} Tiket</td>
                            <td class="text-end fw-bold text-success">Rp {{ number_format($ppt->total_dana, 0, ',', '.') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center text-muted">Belum ada data pendapatan per tanggal.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="card border-0 shadow-sm p-4 bg-white rounded">
        <h5 class="fw-bold text-primary mb-3">📑 Rincian Semua Transaksi Masuk (Lunas)</h5>
        <div class="table-responsive">
            <table class="table table-hover align-middle" style="background-color: #f8fafc;">
                <thead class="table-primary text-primary" style="background-color: #e0e7ff; color: #4f46e5;">
                    <tr>
                        <th>Kode Booking</th>
                        <th>Nama Penumpang</th>
                        <th>Kereta & Kelas</th>
                        <th>Rute Perjalanan</th>
                        <th>Jumlah & Total Harga</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($semuaTransaksi as $transaksi)
                        <tr>
                            <td class="fw-bold text-success">
                                {{ $transaksi->kode_booking ?? 'KAI-' . str_pad($transaksi->id, 5, '0', STR_PAD_LEFT) }}
                            </td>
                            
                            <td>
                                {{ $transaksi->user->name ?? $transaksi->nama_penumpang }}
                            </td>
                            
                            <td>
                                <strong>{{ $transaksi->jadwal->kereta->nama_kereta ?? 'Argo Parahyangan' }}</strong>
                                <small class="text-muted d-block">{{ $transaksi->jadwal->kereta->kelas ?? 'Eksekutif' }}</small>
                            </td>
                            
                            <td>
                                <strong>{{ $transaksi->jadwal->stasiunAsal->nama_stasiun ?? 'Gambir' }}</strong> ➡️ <strong>{{ $transaksi->jadwal->stasiunTujuan->nama_stasiun ?? 'Bandung' }}</strong>
                                <small class="text-muted d-block">{{ isset($transaksi->jadwal->waktu_berangkat) ? \Carbon\Carbon::parse($transaksi->jadwal->waktu_berangkat)->format('d M Y, H:i') : '01 Jul 2026, 07:00' }}</small>
                            </td>
                            
                            <td>
                                <small class="text-muted d-block">{{ $transaksi->jumlah_tiket }} Tiket</small>
                                <span class="fw-bold text-dark">Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}</span>
                            </td>
                            
                            <td>
                                <span class="badge bg-success text-uppercase py-2 px-3 rounded">Lunas</span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">Belum ada riwayat transaksi lunas yang tercatat.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection