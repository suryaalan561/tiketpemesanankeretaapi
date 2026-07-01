<?php

namespace App\Http\Controllers;

use App\Models\Stasiun;
use Illuminate\Http\Request;

class StasiunController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $stasiuns = Stasiun::latest()->get();
        return view('admin.stasiun.index', compact('stasiuns'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // ✨ PERBAIKAN: Baris $this->validate() yang menyebabkan error sudah dihapus.
        // Fungsi ini sekarang murni hanya bertugas memanggil halaman form tambah stasiun baru.
        return view('admin.stasiun.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kode_stasiun' => 'required|unique:stasiuns,kode_stasiun',
            'nama_stasiun' => 'required',
            'kota' => 'required',
        ]);

        Stasiun::create($request->all());
        return redirect()->route('stasiun.index')->with('success', 'Data stasiun berhasil ditambahkan!');
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
        // 1. Validasi inputan data stasiun
        $request->validate([
            'kode_stasiun' => 'required|string|max:10|unique:stasiuns,kode_stasiun,' . $id,
            'nama_stasiun' => 'required|string|max:100',
            'kota'         => 'required|string|max:100',
        ]);

        // 2. Cari data stasiun berdasarkan ID
        $stasiun = Stasiun::findOrFail($id);

        // 3. Simpan perubahan ke database
        $stasiun->update([
            'kode_stasiun' => $request->kode_stasiun,
            'nama_stasiun' => $request->nama_stasiun,
            'kota'         => $request->kota,
        ]);

        // 4. Kembali ke halaman kelola dengan pesan sukses
        return redirect()->route('stasiun.index')->with('success', 'Data stasiun berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $stasiun = Stasiun::findOrFail($id);
        $stasiun->delete();
        return redirect()->route('stasiun.index')->with('success', 'Data stasiun berhasil dihapus!');
    }
}