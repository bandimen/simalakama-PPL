<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IrsPeriods extends Model
{
    use HasFactory;

    protected $table = 'irs_periods';

    protected $fillable = [
        'semester',
        'tahun_ajaran',
        'periode_pengisian_start',
        'periode_pengisian_end',
        'periode_perubahan_start',
        'periode_perubahan_end',
        'periode_pembatalan_start',
        'periode_pembatalan_end',
        'periode_perkuliahan_start',
        'periode_perkuliahan_end',
    ];

    public $timestamps = true; //buat make created at dan updated at
}
