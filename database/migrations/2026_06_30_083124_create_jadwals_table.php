<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('jadwals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kereta_id')->constrained('keretas')->onDelete('cascade');
            $table->foreignId('stasiun_asal_id')->constrained('stasiuns')->onDelete('cascade');
            $table->foreignId('stasiun_tujuan_id')->constrained('stasiuns')->onDelete('cascade');
            $table->dateTime('waktu_berangkat');
            $table->dateTime('waktu_tiba');
            $table->decimal('harga_tiket', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwals');
    }
};