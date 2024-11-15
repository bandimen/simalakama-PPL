<?php

namespace App\Models;

use App\Models\JadwalKuliah;
use Illuminate\Database\Eloquent\Model;

class Ruang extends Model
{
    public function jadwals() {
        return $this->hasMany(JadwalKuliah::class, 'ruang_id', 'id');
    }
}
