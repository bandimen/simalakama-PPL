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

        return view('mhs.akademik.buatirs', 
        [
            'title' => 'Buat Irs Mahasiswa ', 
            'mahasiswa' => $mahasiswa, 
            'currentPeriod' => $currentPeriod,
            'semester' => $semesterMahasiswa,
        ]);
    }
    
    // public function akademik() {
    //     return view('mhs.akademik.buatirs', ['title' => 'Akademik']);
    // }


    public function getJadwal($kodemk)
    {   
        $irsPeriodsController = new IrsPeriodsController();
        $currentPeriod = $irsPeriodsController->getCurrentPeriod();
        // Ambil jadwal berdasarkan kode mata kuliah
        $jadwals = JadwalKuliah::with(['mataKuliah', 'ruang'])
                    ->where('kodemk', $kodemk)
                    ->where('status', 'Disetujui')
                    ->where('tahun_ajaran', $currentPeriod->tahun_ajaran)
                    ->get();

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

    public function getMaxBebanSks()
    {
        $mahasiswa = Auth::user()->mahasiswa;
        $maxBebanSks = $mahasiswa->getMaxBebanSks();

        return response()->json([
            'maxBebanSks' => $maxBebanSks,
        ]);
    }
}
