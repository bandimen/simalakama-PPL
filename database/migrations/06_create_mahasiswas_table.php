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
        Schema::create('mahasiswas', function (Blueprint $table) {
            $table->string('nim')->primary();
            $table->string('nama');
            $table->text('alamat')->nullable();
            $table->year('angkatan');
            $table->string('no_hp')->nullable();
            $table->enum('status', ['Aktif', 'Cuti'])->default('Aktif');
            $table->string('foto')->nullable();
            
            $table->foreignId('prodi_id')->constrained()->onDelete('cascade');
            $table->foreignId('pembimbing_akademik_id')->constrained('pembimbing_akademik')->onDelete('cascade'); 
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); 
            $table->timestamps();
        });    
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mahasiswas');
    }
};
