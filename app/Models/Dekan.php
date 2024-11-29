<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dekan extends Model
{
    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'nidn', 'nidn');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
