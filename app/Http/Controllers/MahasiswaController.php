<?php

namespace App\Http\Controllers;

use Log;
use App\Models\Mahasiswa;
use App\Models\MataKuliah;
use App\Models\JadwalKuliah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class MahasiswaController extends Controller
{
    
    public function index() {
        // data mahasiswa yg diambil di proses sessionController pas login dibawa ke view
        $user = Auth::user();
        $mahasiswa = $user->mahasiswa;
        $pa = $mahasiswa->pembimbingAkademik?->dosen;

        $currentDateTime = now(); 
    
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
            

        return view('mhs.dashboard', 
        [
            'title' => 'Dashboard Mahasiswa', 
            'mahasiswa' => $mahasiswa, 
            'currentPeriod' => $currentPeriod,
            'pa' => $pa,
        ]);
    }

    // public function akademik() {
    //     return view('mhs.akademik.buatirs', ['title' => 'Akademik']);
    // }



    public function getJadwal($kodemk)
    {

        $jadwals = JadwalKuliah::with(['mataKuliah', 'ruang'])
                    ->where('kodemk', $kodemk)
                    ->get();
        return response()->json($jadwals);
    }
    
    
}
