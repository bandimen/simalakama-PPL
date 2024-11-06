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
        return view('mhs.dashboard', ['title' => 'Dashboard Mahasiswa', 'mahasiswa' => $mahasiswa]);
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
