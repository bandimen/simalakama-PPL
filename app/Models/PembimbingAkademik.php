<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PembimbingAkademik extends Model
{
    protected $table = 'pembimbing_akademik';
    protected $fillable = ['nidn'];

    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'nidn', 'nidn');
    }

    public function mahasiswas() {
        return $this->hasMany(Mahasiswa::class);
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
