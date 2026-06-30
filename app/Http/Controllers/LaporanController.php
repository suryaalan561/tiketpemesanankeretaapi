<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    public function index()
    {
        // 1. Menghitung Total Tiket Terjual dari pesanan yang lunas
        $totalTiketTerjual = Pesanan::where('status_pembayaran', 'lunas')
                                    ->sum('jumlah_tiket');

        // 2. Menghitung Total Pendapatan dari kolom total_harga
        $totalPendapatan = Pesanan::where('status_pembayaran', 'lunas')
                                  ->sum('total_harga');

        // 3. Mengambil rincian pendapatan kelompokkan PER TANGGAL (untuk penjelasan detail)
        $pendapatanPerTanggal = Pesanan::where('status_pembayaran', 'lunas')
            ->select(
                DB::raw('DATE(created_at) as tanggal'),
                DB::raw('SUM(jumlah_tiket) as total_tiket'),
                DB::raw('SUM(total_harga) as total_dana')
            )
            ->groupBy(DB::raw('DATE(created_at)'))
            ->orderBy('tanggal', 'DESC')
            ->get();

        // 4. Mengambil seluruh daftar transaksi lunas dengan relasi lengkap agar sama seperti riwayat
        $semuaTransaksi = Pesanan::with(['user', 'jadwal.kereta', 'jadwal.stasiunAsal', 'jadwal.stasiunTujuan'])
                                ->where('status_pembayaran', 'lunas')
                                ->latest()
                                ->get();

        // 5. Mengirim semua data ke halaman view laporan
        return view('admin.laporan.index', compact(
            'totalTiketTerjual', 
            'totalPendapatan', 
            'pendapatanPerTanggal', 
            'semuaTransaksi'
        ));
    }
}