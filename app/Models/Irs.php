<?php

namespace App\Models;

use App\Models\IrsDetail;
use App\Models\Mahasiswa;
use Illuminate\Database\Eloquent\Model;

class Irs extends Model
{
    protected $table = 'irs';
    protected $fillable = [
        'nim',
        'semester',
        'tahun_ajaran',
        'status',
        'total_sks',
    ];

    // relasi ke mahasiswa many to 1
    public function mahasiswa() 
    {
        return $this->belongsTo(Mahasiswa::class, 'nim', 'nim');
    }

    public function details()
    {
        return $this->hasMany(IrsDetail::class, 'irs_id', 'id');
    }

}
