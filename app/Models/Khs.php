<?php

namespace App\Models;

use App\Models\Irs;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Khs extends Model
{
    use HasFactory;

    protected $table = 'khs';

    public function irs()
    {
        return $this->belongsTo(Irs::class, 'irs_id');
    }

    public function details()
    {
        return $this->hasMany(KhsDetails::class, 'khs_id');
    }
}
