<?php

namespace App\Models;

use App\Models\IrsPeriods;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\IrsPeriodsController;

class PembimbingAkademik extends Model
{
    protected $table = 'pembimbing_akademik';
    protected $fillable = ['nidn'];

    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'nidn', 'nidn');
    }

    public function mahasiswas() {
        return $this->hasMany(Mahasiswa::class);
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getTotalMahasiswaPerwalian()
    {
        $mhsPerwalian = $this->mahasiswas;
        return $mhsPerwalian->count();
    }   

    public function getTotalIrsDisetujui()
    {
        $currentPeriod = IrsPeriods::getCurrentPeriod(); // Pindahkan logika periode ke model atau helper, jangan buat instansiasi baru pake new

    
        return $this->mahasiswas()
            ->whereHas('irs', function ($query) use ($currentPeriod) {
                $query->where('status', 'Disetujui')
                      ->where('tahun_ajaran', $currentPeriod->tahun_ajaran)
                      ->where('jenis_semester', $currentPeriod->semester);
            })
            ->count();
    }
    
    public function getTotalIrsBelumDisetujui()
    {
        $currentPeriod = IrsPeriods::getCurrentPeriod(); // Pindahkan logika periode ke model atau helper, jangan buat instansiasi baru pake new

    
        return $this->mahasiswas()
            ->whereHas('irs', function ($query) use ($currentPeriod) {
                $query->where('status', 'Belum disetujui')
                      ->where('tahun_ajaran', $currentPeriod->tahun_ajaran)
                      ->where('jenis_semester', $currentPeriod->semester);
                    })
            ->count();
        }
    
        public function getTotalMhsBelumIrs()
        {
            $currentPeriod = IrsPeriods::getCurrentPeriod();
        
            return $this->mahasiswas()
                ->whereDoesntHave('irs', function ($query) use ($currentPeriod) {
                    $query->where('tahun_ajaran', $currentPeriod->tahun_ajaran)
                          ->where('jenis_semester', $currentPeriod->semester);
                })
                ->count();
        }
        
    }
    