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
        Schema::create('khs_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('khs_id')->constrained()->onDelete('cascade'); 
            $table->string('kodemk'); 
            $table->foreign('kodemk')->references('kodemk')->on('mata_kuliahs')->onDelete('cascade'); 
            $table->integer('nilai'); 
            $table->enum('status', ['Lulus', 'Tidak Lulus']); // Status kelulusan
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('khs_details');
    }
};
