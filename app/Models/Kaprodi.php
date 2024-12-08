<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kaprodi extends Model
{
    protected $table = 'kaprodi';
    protected $fillable = ['nidn'];

    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'nidn', 'nidn');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getMahasiswaAktif() {
        $prodiId = $this->dosen?->prodi_id;
        return Mahasiswa::where('prodi_id', $prodiId)->where('status', 'aktif')->count();
    }

    public function getDosen() {
        $prodiId = $this->dosen?->prodi_id;
        return Dosen::where('prodi_id', $prodiId)->count();
    }

}
