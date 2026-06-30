<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Kereta;
use App\Models\Stasiun;

class Jadwal extends Model
{

    use HasFactory;

    protected $fillable = [
        'kereta_id',
        'stasiun_asal_id',
        'stasiun_tujuan_id',
        'waktu_berangkat',
        'waktu_tiba',
        'harga_tiket',
    ];

    // Relasi ke tabel Kereta
    public function kereta()
    {
        return $this->belongsTo(Kereta::class);
    }

    // Relasi ke tabel Stasiun Asal
    public function stasiunAsal()
    {
        return $this->belongsTo(Stasiun::class, 'stasiun_asal_id');
    }

    // Relasi ke tabel Stasiun Tujuan
    public function stasiunTujuan()
    {
        return $this->belongsTo(Stasiun::class, 'stasiun_tujuan_id');
    }
}