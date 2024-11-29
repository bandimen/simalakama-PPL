<?php

namespace App\Models;

use App\Models\Ruang;
use App\Models\MataKuliah;
use Illuminate\Database\Eloquent\Model;

class JadwalKuliah extends Model
{
    protected $table = 'jadwal_kuliahs';
    protected $fillable = [
        'kodemk',
        'ruang_id',
        'kelas',
        'hari',
        'waktu_mulai',
        'waktu_selesai',
        'status'
    ];

    public function mataKuliah()
    {
        return $this->belongsTo(MataKuliah::class, 'kodemk', 'kodemk');
    }

    public function ruang()
    {
        return $this->belongsTo(Ruang::class, 'ruang_id', 'id'); 
    }

    public function irsDetails()
    {
        return $this->hasMany(IrsDetail::class, 'jadwal_kuliah_id', 'id');
    }

}
