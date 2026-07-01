@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            
            <div class="text-center mb-5">
                <h3 class="fw-bold text-primary m-0">🙋‍♂️ Pusat Bantuan & FAQ</h3>
                <p class="text-muted small mt-1">Punya pertanyaan seputar pemesanan tiket? Temukan jawabannya di bawah ini.</p>
            </div>

            <div class="accordion border-0 shadow-sm rounded-4 overflow-hidden mb-5" id="faqAccordion">
                
                <div class="accordion-item border-0 border-bottom">
                    <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button fw-semibold text-secondary bg-white" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            How-To: Bagaimana cara memesan tiket kereta?
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#faqAccordion">
                        <div class="accordion-body bg-white text-muted">
                            Anda cukup masuk ke menu <strong class="text-primary">Cari Tiket</strong>, tentukan stasiun asal, stasiun tujuan, tanggal keberangkatan, lalu klik tombol cari. Pilih jadwal yang tersedia dan tekan tombol pesan.
                        </div>
                    </div>
                </div>

                <div class="accordion-item border-0 border-bottom">
                    <h2 class="accordion-header" id="headingTwo">
                        <button class="accordion-button collapsed fw-semibold text-secondary bg-white" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            Apakah saya bisa membatalkan tiket yang sudah dibayar?
                        </button>
                    </h2>
                    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#faqAccordion">
                        <div class="accordion-body bg-white text-muted">
                            Untuk saat ini pembatalan tiket secara online belum didukung pada sistem inti. Anda bisa langsung melakukan prosedur pembatalan manual melalui loket stasiun terdekat maksimal 30 menit sebelum jam keberangkatan.
                        </div>
                    </div>
                </div>

                <div class="accordion-item border-0">
                    <h2 class="accordion-header" id="headingThree">
                        <button class="accordion-button collapsed fw-semibold text-secondary bg-white" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            Metode pembayaran apa saja yang didukung?
                        </button>
                    </h2>
                    <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#faqAccordion">
                        <div class="accordion-body bg-white text-muted">
                            Sistem kami mendukung simulasi pembayaran instan. Setelah melakukan pemesanan tiket, Anda dapat masuk ke menu <strong class="text-primary">Riwayat Pesanan</strong> untuk melakukan konfirmasi simulasi pembayaran.
                        </div>
                    </div>
                </div>

            </div>

            <div class="card border-0 shadow-sm p-4 bg-white rounded-4 text-center">
                <h5 class="fw-bold text-dark mb-2">Masih Memiliki Pertanyaan Lain?</h5>
                <p class="text-muted small mb-4">Tim dukungan pelanggan kami siap membantu Anda 24/7 jika terjadi kendala pada sistem.</p>
                
                <div class="row g-3 justify-content-center">
                    <div class="col-6 col-sm-4">
                        <a href="#" class="btn btn-light border w-100 py-2 fw-medium text-secondary">
                            📞 Call Center
                        </a>
                    </div>
                    <div class="col-6 col-sm-4">
                        <a href="#" class="btn btn-outline-success w-100 py-2 fw-medium">
                            💬 WhatsApp Chat
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection