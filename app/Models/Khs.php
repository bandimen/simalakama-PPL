<?php

namespace App\Models;

use App\Models\Irs;
use App\Models\KhsDetails;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Khs extends Model
{
    use HasFactory;

    protected $table = 'khs';

    // Relasi ke IRS
    public function irs()
    {
        return $this->belongsTo(Irs::class, 'irs_id');
    }

    // Relasi ke KHS Detail
    public function khsDetails()
    {
        return $this->hasMany(KhsDetails::class, 'khs_id');
    }
}