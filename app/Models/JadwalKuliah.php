<?php

namespace App\Models;

use App\Models\Ruang;
use App\Models\MataKuliah;
use Illuminate\Database\Eloquent\Model;

class JadwalKuliah extends Model
{
    protected $table = 'jadwal_kuliahs';
    protected $fillable = [
        'kodemk',
        'ruang_id',
        'kelas',
        'hari',
        'tahun_ajaran',
        'kuota_kelas',
        'waktu_mulai',
        'waktu_selesai',
        'status'
    ];

    public function mataKuliah()
    {
        return $this->belongsTo(MataKuliah::class, 'kodemk', 'kodemk');
    }

    public function ruang()
    {
        return $this->belongsTo(Ruang::class, 'ruang_id', 'id');
    }

    public function irsDetails()
    {
        return $this->hasMany(IrsDetail::class, 'jadwal_kuliah_id', 'id');
    }

    public function irsPeriod()
    {
        return $this->belongsTo(IrsPeriods::class, 'tahun_ajaran', 'tahun_ajaran');
    }

    public function scopeSearch($query, $search)
    {
        if ($search) {
            return $query->whereHas('mataKuliah', function ($q) use ($search) {
                $q->where('nama', 'like', '%' . $search . '%');
            })
            ->orWhere('kelas', 'like', '%' . $search . '%')
            ->orWhereHas('ruang', function ($q) use ($search) {
                $q->where('nama', 'like', '%' . $search . '%');
            });
        }
        return $query;
    }
}
