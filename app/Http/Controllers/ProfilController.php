<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class ProfilController extends Controller
{
    // 1. Menampilkan halaman profil penumpang
    public function indeks()
    {
        $user = Auth::user(); // Mengambil data penumpang yang sedang login
        return view('penumpang.profil', compact('user'));
    }

    // 2. Memproses perubahan data profil (Nama, Email, & No Telp)
    public function update(Request $request)
    {
        // Mengambil user melalui model find agar VS Code mengenali method update()
        $user = User::find(Auth::id()); 

        // Validasi inputan
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . Auth::id(),
            'no_telp' => 'nullable|string|max:15', // Validasi nomor telepon (opsional, maks 15 karakter)
        ]);

        // Update data ke database
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'no_telp' => $request->no_telp, // Menyimpan nomor telepon baru
        ]);

        return back()->with('success', 'Profil Anda berhasil diperbarui!');
    }
}