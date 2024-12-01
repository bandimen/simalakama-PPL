<?php

namespace App\Http\Controllers;

use App\Models\Khs;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreKhsRequest;
use App\Http\Requests\UpdateKhsRequest;
use App\Models\Mahasiswa;
use App\Http\Controllers\IrsPeriodsController;

class KhsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreKhsRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Khs $khs)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Khs $khs)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateKhsRequest $request, Khs $khs)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Khs $khs)
    {
        //
    }
    
    public function lihatkhs(Request $request)
    {
        // Ambil data mahasiswa dari user yang login
        $user = Auth::user();
        $mahasiswa = $user->mahasiswa;
    
        // Dapatkan periode saat ini dari IrsPeriodsController
        $irsPeriodsController = new IrsPeriodsController();
        $currentPeriod = $irsPeriodsController->getCurrentPeriod();
    
        // Hitung semester aktif saat ini berdasarkan angkatan mahasiswa dan periode aktif
        $currentSemester = $this->getSemester($mahasiswa->angkatan, $currentPeriod);
    
        // Ambil semester dari parameter URL atau gunakan semester terakhir secara default
        $selectedSemester = $request->query('semester', $currentSemester);
    
        // Ambil data KHS mahasiswa berdasarkan semester yang dipilih
        $khs = Khs::whereHas('irs', function ($query) use ($mahasiswa, $selectedSemester) {
            $query->where('nim', $mahasiswa->nim)
                  ->where('semester', $selectedSemester); // Filter semester langsung di query
        })
        ->with(['irs' => function ($query) use ($selectedSemester) {
            $query->where('semester', $selectedSemester); // Pastikan hanya IRS semester yang dipilih
        }, 'khsDetails.irsDetails.mataKuliah'])
        ->first();
    
        // Kirim data ke view
        return view('mhs.akademik.lihatkhs', [
            'title' => 'Lihat KHS',
            'khs' => $khs,
            'khsDetails' => $khs ? $khs->khsDetails : [],
            'mahasiswa' => $mahasiswa,
            'currentPeriod' => $currentPeriod,
            'currentSemester' => $currentSemester, 
            'selectedSemester' => $selectedSemester,
        ]);
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
