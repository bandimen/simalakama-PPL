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
            $table->foreignId('irs_details_id')->constrained()->onDelete('cascade'); 
            $table->enum('nilai', ['A', 'B', 'C', 'D', 'E']); 
            //$table->enum('status', ['Lulus', 'Tidak Lulus']); // Status kelulusan
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
