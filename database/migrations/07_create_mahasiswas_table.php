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
            $table->enum('status', ['aktif', 'cuti'])->default('aktif');
            $table->string('foto')->nullable();
            
            $table->foreignId('pembimbing_akademik_id')->nullable()->constrained('pembimbing_akademik')->onDelete('set null'); // Make it nullable
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
