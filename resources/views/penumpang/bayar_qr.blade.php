@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center">
    <div class="card border-0 shadow-sm p-4 text-center bg-white rounded" style="max-width: 500px; width: 100%;">
        
        <h4 class="fw-bold text-primary mb-3">🔒 Pembayaran KAI Simple</h4>
        <p class="text-muted small">Silakan scan QR Code di bawah ini untuk menyelesaikan pembayaran tiket Anda.</p>

        <div class="alert alert-danger border-0 py-2 px-3 my-3">
            <span class="fw-bold d-block small mb-1 text-uppercase">Sisa Waktu Pembayaran</span>
            <h3 class="fw-bold m-0" id="countdown-timer">10:00</h3>
        </div>

        <div class="bg-light p-3 rounded text-start mb-4 border">
            <div class="d-flex justify-content-between mb-2">
                <span class="text-muted">Kode Booking:</span>
                <span class="fw-bold text-success">{{ $pesanan->kode_booking }}</span>
            </div>
            <div class="d-flex justify-content-between mb-2">
                <span class="text-muted">Jumlah Tiket:</span>
                <span class="fw-bold">{{ $pesanan->jumlah_tiket }} Tiket</span>
            </div>
            <hr class="my-2">
            <div class="d-flex justify-content-between align-items-center">
                <span class="text-muted fw-bold">Total Tagihan:</span>
                <span class="fw-bold text-danger fs-5">Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}</span>
            </div>
        </div>

        <div class="my-4 p-3 border rounded d-inline-block bg-white mx-auto shadow-sm" style="max-width: 240px;">
            <img src="https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=KAISIMPLE-PAYMENT-{{ $pesanan->kode_booking }}" 
                 alt="QR Code Pembayaran" class="img-fluid rounded">
            <div class="mt-2 small text-muted fw-bold">QRIS KAI Simple Official</div>
        </div>

        <div class="row g-2 mt-2">
            <div class="col-6">
                <a href="{{ route('pesanan.riwayat') }}" class="btn btn-outline-secondary w-100 fw-bold">
                    ⬅️ Kembali
                </a>
            </div>
            <div class="col-6">
                <form action="{{ route('pesanan.konfirmasi-bayar', $pesanan->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-success w-100 fw-bold">
                        ✅ Selesai
                    </button>
                </form>
            </div>
        </div>

    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        // 🌟 Membulatkan sisa detik dari server menggunakan Math.floor agar tidak desimal
        let totalDetik = Math.floor({{ $sisaDetik }});
        const displayTimer = document.getElementById('countdown-timer');

        function updateTimer() {
            if (totalDetik <= 0) {
                clearInterval(intervalId);
                displayTimer.innerHTML = "WAKTU HABIS";
                alert("Waktu pembayaran telah habis! Halaman akan dialihkan.");
                window.location.reload();
                return;
            }

            let menit = Math.floor(totalDetik / 60);
            let detik = totalDetik % 60;

            // Format agar selalu 2 digit angka (contoh: 09:05)
            menit = menit < 10 ? '0' + menit : menit;
            detik = detik < 10 ? '0' + detik : detik;

            displayTimer.innerHTML = menit + ":" + detik;
            totalDetik--;
        }

        // Jalankan timer pertama kali dan ulangi setiap 1 detik
        updateTimer();
        const intervalId = setInterval(updateTimer, 1000);
    });
</script>
@endsection