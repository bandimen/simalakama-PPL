<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    protected $fillable = [
        'nim',
        'nama',
        'alamat',
        'angkatan',
        'no_hp',
        'status',
        'foto',
        'pembimbing_akademik_id' // Ubah ini
    ];

    public function pembimbingAkademik()
    {
        return $this->belongsTo(PembimbingAkademik::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function irs()
    {
        return $this->hasMany(Irs::class, 'nim', 'nim');
    }
}
