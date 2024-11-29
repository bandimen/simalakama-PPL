<?php

namespace App\Models;

use App\Models\Prodi;
use App\Models\JadwalKuliah;
use Illuminate\Database\Eloquent\Model;

class Ruang extends Model
{
    protected $table = 'ruangs';
    protected $fillable = ['nama', 'gedung', 'kapasitas', 'prodi_id','status'];

    public function jadwals() {
        return $this->hasMany(JadwalKuliah::class, 'ruang_id', 'id');
    }

    public function prodi()
    {
        return $this->belongsTo(Prodi::class);
    }
}
