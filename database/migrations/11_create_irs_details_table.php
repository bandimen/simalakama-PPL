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
            Schema::create('irs_details', function (Blueprint $table) {
                $table->id();
                $table->foreignId('irs_id')->constrained()->onDelete('cascade');
                $table->string('kodemk');
                $table->foreign('kodemk')->references('kodemk')->on('mata_kuliahs')->onDelete('cascade');
                $table->foreignId('jadwal_kuliah_id')->constrained()->onDelete('cascade');
                $table->enum('status', ['Baru', 'Perbaikan', 'Ulang']);
                $table->timestamps();
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('irs_details');
    }
};
