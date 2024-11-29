<?php

namespace App\Models;

use App\Models\Dosen;
use App\Models\Ruang;
use App\Models\Mahasiswa;
use App\Models\MataKuliah;
use Illuminate\Database\Eloquent\Model;

class Prodi extends Model
{
    protected $fillable = ['nama'];
    public function mahasiswa()
    {
        return $this->hasMany(Mahasiswa::class);
    }

    public function dosen()
    {
        return $this->hasMany(Dosen::class);
    }

    public function ruang()
    {
        return $this->hasMany(Ruang::class,'prodi_id','id');
    }

    public function mataKuliah()
    {
        return $this->hasMany(MataKuliah::class);
    }
}
