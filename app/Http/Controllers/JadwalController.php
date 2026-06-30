<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\Kereta;
use App\Models\Stasiun;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Mengambil data jadwal, kereta, dan stasiun untuk keperluan tabel & modal
        $jadwals = Jadwal::with(['kereta', 'stasiunAsal', 'stasiunTujuan'])->latest()->get();
        $keretas = Kereta::all();
        $stasiuns = Stasiun::all();

        // Mengembalikan view bersih tanpa hitungan total pendapatan/tiket lagi
        return view('admin.jadwal.index', compact('jadwals', 'keretas', 'stasiuns'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $keretas = Kereta::all();
        $stasiuns = Stasiun::all();
        return view('admin.jadwal.create', compact('keretas', 'stasiuns'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kereta_id' => 'required',
            'stasiun_asal_id' => 'required',
            'stasiun_tujuan_id' => 'required',
            'waktu_berangkat' => 'required',
            'waktu_tiba' => 'required',
            'harga_tiket' => 'required|numeric',
        ]);

        Jadwal::create($request->all());

        return redirect()->route('jadwal.index')->with('success', 'Jadwal rute berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Kosong karena template dibuat ringkas
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Kosong karena template dibuat ringkas
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // 1. Validasi inputan data jadwal rute
        $request->validate([
            'kereta_id'         => 'required|exists:keretas,id',
            'stasiun_asal_id'   => 'required|exists:stasiuns,id',
            'stasiun_tujuan_id' => 'required|exists:stasiuns,id',
            'waktu_berangkat'   => 'required',
            'waktu_tiba'        => 'required',
            'harga_tiket'       => 'required|numeric|min:0',
        ]);

        // 2. Cari data jadwal berdasarkan ID
        $jadwal = Jadwal::findOrFail($id);

        // 3. Simpan perubahan ke database
        $jadwal->update([
            'kereta_id'         => $request->kereta_id,
            'stasiun_asal_id'   => $request->stasiun_asal_id,
            'stasiun_tujuan_id' => $request->stasiun_tujuan_id,
            'waktu_berangkat'   => $request->waktu_berangkat,
            'waktu_tiba'        => $request->waktu_tiba,
            'harga_tiket'       => $request->harga_tiket,
        ]);

        // 4. Kembali ke halaman kelola dengan pesan sukses
        return redirect()->route('jadwal.index')->with('success', 'Jadwal rute berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $jadwal = Jadwal::findOrFail($id);
        $jadwal->delete();

        return redirect()->route('jadwal.index')->with('success', 'Jadwal rute berhasil dihapus!');
    }
}