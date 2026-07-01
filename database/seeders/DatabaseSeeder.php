<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Stasiun;
use App\Models\Kereta;
use App\Models\Jadwal;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. ISI DATA USER (Uji Coba Multi-role)
        User::create([
            'name' => 'Akun Admin KAI',
            'email' => 'admin@kai.com',
            'password' => Hash::make('password123'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Budi Penumpang',
            'email' => 'budi@email.com',
            'password' => Hash::make('password123'),
            'role' => 'penumpang',
        ]);

        // 2. ISI DATA STASIUN
        $gmr = Stasiun::create(['kode_stasiun' => 'GMR', 'nama_stasiun' => 'Gambir', 'kota' => 'Jakarta']);
        $bdg = Stasiun::create(['kode_stasiun' => 'BDG', 'nama_stasiun' => 'Bandung', 'kota' => 'Bandung']);
        $smt = Stasiun::create(['kode_stasiun' => 'SMT', 'nama_stasiun' => 'Semarang Tawang', 'kota' => 'Semarang']);

        // 3. ISI DATA KERETA
        $argo = Kereta::create(['nama_kereta' => 'Argo Parahyangan', 'kelas' => 'Eksekutif', 'total_kursi' => 50]);
        $matarmaja = Kereta::create(['nama_kereta' => 'Matarmaja', 'kelas' => 'Ekonomi', 'total_kursi' => 106]);

        // 4. ISI DATA JADWAL (Untuk simulasi pencarian tiket langsung muncul)
        Jadwal::create([
            'kereta_id' => $argo->id,
            'stasiun_asal_id' => $gmr->id,
            'stasiun_tujuan_id' => $bdg->id,
            'waktu_berangkat' => '2026-07-01 07:00:00',
            'waktu_tiba' => '2026-07-01 10:15:00',
            'harga_tiket' => 150000,
        ]);
    }
}