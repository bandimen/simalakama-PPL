<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PengampuMataKuliah;

class DosenController extends Controller
{
    public function pengampuMataKuliah()
    {
        return $this->hasMany(PengampuMataKuliah::class, 'nidn', 'nidn');
    }
}
