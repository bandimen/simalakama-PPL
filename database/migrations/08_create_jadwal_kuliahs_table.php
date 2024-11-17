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
        Schema::create('jadwal_kuliahs', function (Blueprint $table) {
            $table->id();
            $table->string('kodemk');
            $table->foreign('kodemk')->references('kodemk')->on('mata_kuliahs')->onDelete('cascade');
            $table->unsignedBigInteger('ruang_id'); 
            $table->foreign('ruang_id')->references('id')->on('ruangs')->onDelete('cascade');
            $table->string('kelas');
            $table->string('hari');
            $table->string('tahun_ajaran');
            $table->integer('kuota_kelas');
            $table->time('waktu_mulai');
            $table->time('waktu_selesai');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal_kuliahs');
    }
};
