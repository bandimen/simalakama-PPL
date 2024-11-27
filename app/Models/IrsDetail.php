<?php

namespace App\Models;

use App\Models\Irs;
use App\Models\JadwalKuliah;
use Illuminate\Database\Eloquent\Model;

class IrsDetail extends Model
{
    protected $fillable = [
        'irs_id',
        'kodemk',
        'jadwal_kuliah_id',
        'status',
    ];

    public function irs() 
    {
        return $this->belongsTo(Irs::class, 'irs_id', 'id');
    }

    public function mataKuliah()
    {
        return $this->belongsTo(MataKuliah::class, 'kodemk', 'kodemk');
    }

    public function jadwalKuliah()
    {
        return $this->belongsTo(JadwalKuliah::class, 'jadwal_kuliah_id', 'id');    }

    public function khsDetails()
    {
        return $this->hasOne(KhsDetails::class, 'irs_details_id');
    }    
}
