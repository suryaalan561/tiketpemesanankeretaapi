@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="card border-0 shadow-sm rounded-4 p-4" style="background: linear-gradient(135deg, #4f46e5 0%, #3b82f6 100%); color: white;">
                <div class="d-flex align-items-center gap-3">
                    <div class="bg-white bg-opacity-20 p-3 rounded-3 fs-3">🏢</div>
                    <div>
                        <h2 class="fw-bold mb-1">Denah Stasiun</h2>
                        <p class="mb-0 opacity-75">Panduan denah fisik dan fasilitas stasiun kelolaan KAI untuk mempermudah Anda menemukan titik boarding.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card border-0 shadow-sm rounded-4 p-4">
                <h4 class="fw-bold text-dark mb-2">Panduan Denah Fisik & Fasilitas Dasar</h4>
                <p class="text-muted mb-4">Standardisasi tata letak lantai dasar stasiun besar untuk mempermudah navigasi keberangkatan Anda.</p>

                <div class="row g-4">
                    <div class="col-lg-8">
                        <div class="p-3 border rounded-4 bg-light">
                            <div class="text-center fw-bold text-xs text-uppercase tracking-wider text-muted mb-3">=== REL UTAMA & AREA PERON KERETA ===</div>
                            <div class="row g-2 text-center text-white fw-bold">
                                <div class="col-12">
                                    <div class="p-3 rounded-3 shadow-sm mb-2" style="background-color: #334155;">🚧 JALUR PERON 1 & JALUR PERON 2</div>
                                </div>
                                <div class="col-6">
                                    <div class="p-4 bg-primary rounded-3 shadow-sm">🛋️ RUANG TUNGGU UTAMA</div>
                                </div>
                                <div class="col-6">
                                    <div class="p-4 rounded-3 shadow-sm" style="background-color: #6366f1;">🎫 GERBANG SCAN / BOARDING GATE</div>
                                </div>
                                <div class="col-4">
                                    <div class="p-3 bg-success rounded-3 shadow-sm">🍽️ FOOD COURT</div>
                                </div>
                                <div class="col-4">
                                    <div class="p-3 bg-info rounded-3 shadow-sm">🚻 TOILET & MUSHOLA</div>
                                </div>
                                <div class="col-4">
                                    <div class="p-3 bg-secondary rounded-3 shadow-sm">💼 CS & POS KESEHATAN</div>
                                </div>
                                <div class="col-12 mt-2">
                                    <div class="p-2 border border-dark border-dashed rounded-3 text-dark fw-medium bg-white">🚪 PINTU MASUK UTAMA / LOBBY DROP-OFF</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="border rounded-4 p-3 bg-white h-100">
                            <h5 class="fw-bold text-dark mb-3">Informasi Fasilitas</h5>
                            <div class="table-responsive">
                                <table class="table table-sm table-borderless m-0 align-middle">
                                    <tbody>
                                        <tr class="border-bottom">
                                            <td class="py-2"><span class="fs-5">🛋️</span></td>
                                            <td class="py-2"><span class="fw-bold text-dark d-block">Ruang Tunggu</span> <small class="text-muted">Dilengkapi stopkontak & AC</small></td>
                                        </tr>
                                        <tr class="border-bottom">
                                            <td class="py-2"><span class="fs-5">🎫</span></td>
                                            <td class="py-2"><span class="fw-bold text-dark d-block">Check-In / Boarding</span> <small class="text-muted">Siapkan KTP & E-Tiket</small></td>
                                        </tr>
                                        <tr class="border-bottom">
                                            <td class="py-2"><span class="fs-5">🚻</span></td>
                                            <td class="py-2"><span class="fw-bold text-dark d-block">Fasilitas Umum</span> <small class="text-muted">Ramah penyandang disabilitas</small></td>
                                        </tr>
                                        <tr>
                                            <td class="py-2"><span class="fs-5">💼</span></td>
                                            <td class="py-2"><span class="fw-bold text-dark d-block">Lost and Found</span> <small class="text-muted">Layanan barang tertinggal</small></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection