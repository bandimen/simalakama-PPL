<?php

namespace App\Http\Controllers;

use Log;
use App\Models\Mahasiswa;
use App\Models\MataKuliah;
use App\Models\JadwalKuliah;
use App\Models\IrsPeriods;
use App\Models\Irs;
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

        $irsPeriodsController = new IrsPeriodsController();
        $currentPeriod = $irsPeriodsController->getCurrentPeriod();
        $semesterMahasiswa = $this->getSemester($mahasiswa->angkatan, $currentPeriod);

        
        return view('mhs.dashboard', 
        [
            'title' => 'Dashboard Mahasiswa', 
            'mahasiswa' => $mahasiswa, 
            'currentPeriod' => $currentPeriod,
            'pa' => $pa,
            'semester' => $semesterMahasiswa,
        ]);
    }
    


    // public function akademik() {
    //     return view('mhs.akademik.buatirs', ['title' => 'Akademik']);
    // }


    public function getJadwal($kodemk)
    {    
        // Ambil periode aktif saat ini
        $currentPeriod = IrsPeriods::getCurrentPeriod();
    
        if (!$currentPeriod) {
            return response()->json(['message' => 'Periode IRS tidak ditemukan'], 404);
        }
    
        // Ambil jadwal berdasarkan kode mata kuliah dan tahun ajaran dari periode aktif
        $jadwals = JadwalKuliah::with(['mataKuliah', 'ruang'])
                    ->where('kodemk', $kodemk)
                    ->where('tahun_ajaran', $currentPeriod->tahun_ajaran) // Filter berdasarkan tahun ajaran
                    ->get();
    
        // Log untuk debugging
        Log::info('Jadwal diambil', [
            'kodemk' => $kodemk,
            'tahun_ajaran' => $currentPeriod->tahun_ajaran,
            'result_count' => $jadwals->count()
        ]);
    
        return response()->json($jadwals);
    }    
 
    public function getSemester($angkatan, $currentPeriod)
    {
        // Pisahkan tahun akademik menjadi tahun awal dan akhir
        $currentTahunAjaran = explode('/', $currentPeriod->tahun_ajaran);
        $currentTahunAwal = (int)$currentTahunAjaran[0];
    
        // Tentukan tahun angkatan mahasiswa
        $tahunAngkatan = (int)$angkatan;
    
        // Hitung selisih tahun antara tahun angkatan mahasiswa dan tahun ajaran saat ini
        $selisihTahun = $currentTahunAwal - $tahunAngkatan;
    
        // Setiap tahun memiliki 2 semester (ganjil dan genap), lakukan perhitungan berdasarkan semester aktif
        if ($currentPeriod->semester == 'Gasal') {
            // Jika semester Gasal (ganjil), tambahkan 1 untuk semester ganjil
            $semester = ($selisihTahun * 2) + 1;
        } elseif ($currentPeriod->semester == 'Genap') {
            // Jika semester Genap, tambahkan 2 untuk semester genap
            $semester = ($selisihTahun * 2) + 2;
        }
        
        return $semester;
    }

}
