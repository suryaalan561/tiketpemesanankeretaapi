<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public functio n up(): void
    {
        Schema::create('keretas', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kereta');
            $table->string('kelas'); // Eksekutif, Bisnis, Ekonomi
            $table->integer('total_kursi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('keretas');
    }
};