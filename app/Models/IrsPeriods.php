<?php

namespace App\Models;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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

    public static function getCurrentPeriod()
    {
        $currentDateTime = Carbon::now(); // Sesuaikan dengan waktu yang diperlukan

        $currentPeriod = DB::table('irs_periods')
            ->where(function($query) use ($currentDateTime) {
                $query->where('periode_pengisian_start', '<=', $currentDateTime)
                      ->where('periode_pengisian_end', '>=', $currentDateTime)
                      ->orWhere(function($query) use ($currentDateTime) {
                          $query->where('periode_perubahan_start', '<=', $currentDateTime)
                                ->where('periode_perubahan_end', '>=', $currentDateTime);
                      })
                      ->orWhere(function($query) use ($currentDateTime) {
                          $query->where('periode_pembatalan_start', '<=', $currentDateTime)
                                ->where('periode_pembatalan_end', '>=', $currentDateTime);
                      })
                      ->orWhere(function($query) use ($currentDateTime) {
                          $query->where('periode_perkuliahan_start', '<=', $currentDateTime)
                                ->where('periode_perkuliahan_end', '>=', $currentDateTime);
                      });
            })
            ->first();

        return $currentPeriod;
    }
}
