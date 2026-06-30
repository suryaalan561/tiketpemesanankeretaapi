<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    use HasFactory;

    // Kolom-kolom yang diizinkan untuk diisi secara massal (Mass Assignment)
    protected $fillable = [
        'kode_booking',
        'user_id',
        'jadwal_id',
        'jumlah_tiket',
        'total_harga',
        'status_pembayaran', // Baris ini sudah aman terdaftar
    ];

    // Relasi ke tabel User (Siapa yang memesan / Penumpang)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke tabel Jadwal (Kereta & Rute apa yang dipesan)
    public function jadwal()
    {
        return $this->belongsTo(Jadwal::class);
    }
}