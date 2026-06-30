<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str; 
use Illuminate\Support\Facades\Auth; 
use App\Models\Pesanan; 
use App\Models\Jadwal; 
use App\Models\Stasiun; 

class PemesananController extends Controller
{
    // Halaman Cari Tiket (Akses: Penumpang)
    public function indeksCari(Request $request)
    {
        $stasiuns = Stasiun::all();

        // Membuat query dasar untuk mengambil semua jadwal yang aktif beserta relasinya
        $query = Jadwal::with(['kereta', 'stasiunAsal', 'stasiunTujuan'])->latest();

        // Saring otomatis hanya jika user memilih filter pencarian tertentu
        if ($request->filled('asal')) {
            $query->where('stasiun_asal_id', $request->asal);
        }
        if ($request->filled('tujuan')) {
            $query->where('stasiun_tujuan_id', $request->tujuan);
        }
        if ($request->filled('tanggal')) {
            $query->whereDate('waktu_berangkat', $request->tanggal);
        }

        // Ambil hasil akhir (menampilkan semua jika tanpa filter, atau menampilkan hasil saringan)
        $jadwals = $query->get();

        return view('penumpang.cari', compact('stasiuns', 'jadwals'));
    }

    // Proses Booking Tiket
    public function pesan(Request $request, $jadwalId)
    {
        $jadwal = Jadwal::findOrFail($jadwalId);
        
        Pesanan::create([
            'kode_booking' => 'KAI-' . strtoupper(Str::random(6)),
            'user_id' => Auth::id(),
            'jadwal_id' => $jadwal->id, 
            'jumlah_tiket' => $request->jumlah_tiket ?? 1, 
            'total_harga' => $jadwal->harga_tiket * ($request->jumlah_tiket ?? 1),
            'status_pembayaran' => 'belum_bayar'
        ]);

        return redirect()->route('pesanan.riwayat')->with('success', 'Booking berhasil! Silakan lakukan pembayaran.');
    }

    // Riwayat Pesanan (Akses: Admin & Penumpang)
    public function riwayat()
    {
        if (Auth::user()->role == 'admin') {
            $pesanans = Pesanan::with(['user', 'jadwal.kereta'])->latest()->get();
        } else {
            $pesanans = Pesanan::where('user_id', Auth::id())->with('jadwal.kereta')->latest()->get();
        }
        return view('shared.riwayat', compact('pesanans'));
    }

    // Fungsi Baru: Tambah / Kurang Jumlah Tiket sebelum dibayar
    public function updateTiket(Request $request, $id)
    {
        $pesanan = Pesanan::with('jadwal')->findOrFail($id);
        
        // Pastikan hanya bisa diubah jika statusnya memang belum dibayar
        if ($pesanan->status_pembayaran !== 'belum_bayar') {
            return back()->with('error', 'Pesanan yang sudah lunas tidak bisa diubah.');
        }

        $jumlahBaru = $pesanan->jumlah_tiket;

        if ($request->aksi === 'tambah') {
            $jumlahBaru++;
        } elseif ($request->aksi === 'kurang' && $jumlahBaru > 1) {
            $jumlahBaru--;
        }

        // Hitung ulang total harga berdasarkan kuantitas baru
        $pesanan->update([
            'jumlah_tiket' => $jumlahBaru,
            'total_harga' => $pesanan->jadwal->harga_tiket * $jumlahBaru
        ]);

        return back();
    }

    // 🌟 SISIPAN BARU: Fungsi untuk membatalkan pesanan (Hanya jika belum bayar)
    public function batalkanPesanan($id)
    {
        // Cari data pesanan berdasarkan ID menggunakan Model Pesanan resmi proyek Anda
        $pesanan = Pesanan::findOrFail($id);

        // Validasi keamanan: Pastikan statusnya memang masih belum_bayar
        if ($pesanan->status_pembayaran == 'belum_bayar') {
            $pesanan->update([
                'status_pembayaran' => 'batal'
            ]);

            return redirect()->route('pesanan.riwayat')->with('success', 'Pesanan tiket berhasil dibatalkan.');
        }

        return redirect()->route('pesanan.riwayat')->with('error', 'Pesanan ini tidak dapat dibatalkan.');
    }

    // 🌟 SISIPAN BARU: Fungsi untuk melihat / cetak bukti tiket bagi petugas stasiun
    public function cetakTiket($id)
    {
        // Cari data pesanan lengkap beserta relasi jadwal, kereta, stasiun, dan usernya
        $pesanan = Pesanan::with(['jadwal.kereta', 'jadwal.stasiunAsal', 'jadwal.stasiunTujuan', 'user'])->findOrFail($id);

        // Pastikan tiket sudah lunas sebelum boleh dilihat
        if ($pesanan->status_pembayaran != 'lunas') {
            return redirect()->route('pesanan.riwayat')->with('error', 'Anda belum melakukan pembayaran untuk tiket ini.');
        }

        // Arahkan ke halaman struk tiket khusus untuk bukti petugas
        return view('penumpang.tiket_bukti', compact('pesanan'));
    }

    // 🌟 PERUBAHAN DI SINI: Menampilkan halaman pembayaran dengan QR Code & Timer
    public function halamanBayar($id)
    {
        $pesanan = Pesanan::with('jadwal')->findOrFail($id);

        // Jika sudah lunas atau batal, kembalikan ke riwayat
        if ($pesanan->status_pembayaran !== 'belum_bayar') {
            return redirect()->route('pesanan.riwayat');
        }

        // Hitung batas waktu bayar (Waktu dibuat + 10 Menit)
        $waktuDibuat = \Carbon\Carbon::parse($pesanan->created_at);
        $batasWaktu = $waktuDibuat->copy()->addMinutes(10);
        $sekarang = \Carbon\Carbon::now();

        // Jika waktu sekarang sudah melewati batas 10 menit, batalkan otomatis
        if ($sekarang->greaterThanOrEqualTo($batasWaktu)) {
            $pesanan->update(['status_pembayaran' => 'batal']);
            return redirect()->route('pesanan.riwayat')->with('error', 'Waktu pembayaran telah habis (melebihi 10 menit). Pesanan otomatis dibatalkan.');
        }

        // Hitung sisa waktu dalam satuan detik untuk dikirim ke JavaScript timer
        $sisaDetik = $sekarang->diffInSeconds($batasWaktu, false);

        return view('penumpang.bayar_qr', compact('pesanan', 'sisaDetik'));
    }

    // 🌟 PERUBAHAN DI SINI: Memproses konfirmasi lunas saat tombol Selesai diklik
    public function prosesBayar($id)
    {
        $pesanan = Pesanan::findOrFail($id);
        
        // Pastikan belum kedaluwarsa saat tombol diklik
        $batasWaktu = \Carbon\Carbon::parse($pesanan->created_at)->addMinutes(10);
        if (\Carbon\Carbon::now()->greaterThanOrEqualTo($batasWaktu)) {
            $pesanan->update(['status_pembayaran' => 'batal']);
            return redirect()->route('pesanan.riwayat')->with('error', 'Gagal memproses. Waktu pembayaran Anda sudah habis.');
        }

        $pesanan->update(['status_pembayaran' => 'lunas']);
        return redirect()->route('pesanan.riwayat')->with('success', 'Pembayaran berhasil dikonfirmasi! Tiket Anda kini aktif.');
    }
}