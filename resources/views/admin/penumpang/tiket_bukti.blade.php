<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Tiket Resmi - {{ $pesanan->kode_booking }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <link href="https://fonts.googleapis.com/css2?family=Libre+Barcode+39&display=swap" rel="stylesheet">

    <style>
        body { background-color: #f1f5f9; font-family: system-ui, -apple-system, sans-serif; }
        .ticket-box { max-width: 650px; margin: 30px auto; border: 2px dashed #cbd5e1; background: #fff; border-radius: 12px; overflow: hidden; }
        .ticket-header { background: linear-gradient(135deg, #1e3a8a, #3b82f6); color: white; padding: 20px; }
        
        /* 🌟 CSS BARU UNTUK BARCODE 1 DIMENSI */
        .barcode-batang {
            font-family: 'Libre Barcode 39', cursive;
            font-size: 55px; /* Mengatur tinggi batang barcode */
            line-height: 1;
            letter-spacing: 2px;
            color: #000;
            display: inline-block;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="ticket-box shadow-sm">
        <div class="ticket-header d-flex justify-content-between align-items-center">
            <div>
                <h4 class="fw-bold m-0">🚂 KAI Simple BOARDING PASS</h4>
                <small class="opacity-75">Tunjukkan e-tiket ini kepada petugas di pintu masuk stasiun</small>
            </div>
            <div class="text-end">
                <span class="badge bg-success fs-6 py-2 px-3">LUNAS / PAID</span>
            </div>
        </div>

        <div class="p-4">
            <div class="row mb-4 bg-light p-3 rounded border align-items-center">
                <div class="col-6">
                    <small class="text-muted d-block uppercase fw-bold">KODE BOOKING</small>
                    <h3 class="fw-bold text-success m-0">{{ $pesanan->kode_booking }}</h3>
                </div>
                <div class="col-6 text-end">
                    <div class="barcode-batang">*{{ $pesanan->kode_booking }}*</div>
                    <small class="text-muted d-block mt-1">Alat Bukti Check-In Resmi</small>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-6">
                    <label class="text-muted small fw-semibold">Nama Penumpang</label>
                    <p class="fw-bold fs-5 text-dark">{{ $pesanan->user->name }}</p>
                </div>
                <div class="col-6 text-end">
                    <label class="text-muted small fw-semibold">Email / Kontak</label>
                    <p class="fw-bold text-dark">{{ $pesanan->user->email }}</p>
                </div>
            </div>

            <hr>

            <div class="row my-3">
                <div class="col-12 mb-2">
                    <span class="badge bg-primary px-3 py-2">{{ $pesanan->jadwal->kereta->nama_kereta }} ({{ $pesanan->jadwal->kereta->kelas }})</span>
                </div>
                <div class="col-5">
                    <h5 class="fw-bold text-primary m-0">{{ $pesanan->jadwal->stasiunAsal->nama_stasiun }} ({{ $pesanan->jadwal->stasiunAsal->kode_stasiun }})</h5>
                    <small class="text-muted">{{ $pesanan->jadwal->stasiunAsal->kota }}</small>
                    <p class="mt-2 fw-semibold text-secondary">{{ \Carbon\Carbon::parse($pesanan->jadwal->waktu_berangkat)->format('d M Y - H:i') }}</p>
                </div>
                <div class="col-2 text-center align-self-center fs-3 text-muted">
                    ➡️
                </div>
                <div class="col-5 text-end">
                    <h5 class="fw-bold text-primary m-0">{{ $pesanan->jadwal->stasiunTujuan->nama_stasiun }} ({{ $pesanan->jadwal->stasiunTujuan->kode_stasiun }})</h5>
                    <small class="text-muted">{{ $pesanan->jadwal->stasiunTujuan->kota }}</small>
                    <p class="mt-2 fw-semibold text-secondary">{{ \Carbon\Carbon::parse($pesanan->jadwal->waktu_tiba)->format('d M Y - H:i') }}</p>
                </div>
            </div>

            <hr>

            <div class="row bg-light p-3 rounded border align-items-center">
                <div class="col-6">
                    <small class="text-muted d-block">Jumlah Tiket yang Dibeli</small>
                    <span class="fw-bold text-dark fs-5">{{ $pesanan->jumlah_tiket }} Orang (Penumpang)</span>
                </div>
                <div class="col-6 text-end">
                    <small class="text-muted d-block">Total Pembayaran Terverifikasi</small>
                    <span class="fw-bold text-danger fs-4">Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}</span>
                </div>
            </div>
            
            <div class="text-center mt-4">
                <button onclick="window.print()" class="btn btn-outline-secondary btn-sm no-print fw-bold px-4">🖨️ Cetak / Simpan PDF</button>
            </div>
        </div>
    </div>
</div>

<style>
    /* CSS tambahan agar tombol cetak menghilang otomatis saat tiket di-print atau diubah jadi PDF */
    @media print {
        .no-print { display: none !important; }
        body { background-color: #fff; }
        .ticket-box { border: none; margin: 0; box-shadow: none !important; }
    }
</style>

</body>
</html>