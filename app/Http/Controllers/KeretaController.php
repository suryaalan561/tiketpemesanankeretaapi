<?php

namespace App\Http\Controllers;

use App\Models\Kereta;
use Illuminate\Http\Request;

class KeretaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $keretas = Kereta::latest()->get();
        return view('admin.kereta.index', compact('keretas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.kereta.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_kereta' => 'required',
            'kelas' => 'required',
            'total_kursi' => 'required|numeric|min:1',
        ]);

        Kereta::create($request->all());
        return redirect()->route('kereta.index')->with('success', 'Data kereta berhasil ditambahkan!');
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
        // 1. Validasi inputan data kereta
        $request->validate([
            'nama_kereta' => 'required|string|max:100',
            'kelas'       => 'required|string|max:50',
            'total_kursi' => 'required|integer|min:1',
        ]);

        // 2. Cari data kereta berdasarkan ID
        $kereta = Kereta::findOrFail($id);

        // 3. Simpan perubahan ke database
        $kereta->update([
            'nama_kereta' => $request->nama_kereta,
            'kelas'       => $request->kelas,
            'total_kursi' => $request->total_kursi,
        ]);

        // 4. Kembali ke halaman kelola dengan pesan sukses
        return redirect()->route('kereta.index')->with('success', 'Data kereta berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $kereta = Kereta::findOrFail($id);
        $kereta->delete();
        return redirect()->route('kereta.index')->with('success', 'Data kereta berhasil dihapus!');
    }
}