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
        Schema::create('irs_periods', function (Blueprint $table) {
            $table->id();
            $table->enum('semester', ['Gasal', 'Genap']);
            $table->string('tahun_ajaran')->unique();
            $table->datetime('periode_pengisian_start');
            $table->datetime('periode_pengisian_end');
            $table->datetime('periode_perubahan_start');
            $table->datetime('periode_perubahan_end');
            $table->datetime('periode_pembatalan_start');
            $table->datetime('periode_pembatalan_end');
            $table->datetime('periode_perkuliahan_start');
            $table->datetime('periode_perkuliahan_end');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('irs_periods');
    }
};
