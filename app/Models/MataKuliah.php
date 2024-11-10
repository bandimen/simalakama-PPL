<?php

namespace App\Models;

use App\Models\IrsDetail;
use App\Models\JadwalKuliah;
use Illuminate\Database\Eloquent\Model;

class MataKuliah extends Model
{

    protected $fillable = [
        'kodemk',
        'nama',
        'sks',
        'semester',
        'sifat',
    ];

    public function jadwals() {
        return $this->hasMany(JadwalKuliah::class, 'kodemk', 'kodemk');
    }

    public function irsDetails(){
        return $this->hasMany(IrsDetail::class, 'kodemk', 'kodemk');
    }

    // Relasi ke JadwalKuliah
    public function jadwalKuliah()
    {
        return $this->hasMany(JadwalKuliah::class, 'kodemk', 'kodemk');
    }


    public function pengampuMataKuliah()
    {
        return $this->hasMany(PengampuMataKuliah::class, 'kodemk', 'kodemk');
    }
}
