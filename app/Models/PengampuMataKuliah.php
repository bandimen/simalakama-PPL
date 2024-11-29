<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PengampuMataKuliah extends Model
{
    protected $fillable = ['nidn', 'kodemk'];

    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'nidn', 'nidn');
    }

    public function mataKuliah()
    {
        return $this->belongsTo(MataKuliah::class, 'kodemk', 'kodemk');
    }
}
