<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IrsPeriodsController extends Controller
{
    public function getCurrentPeriod()
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
