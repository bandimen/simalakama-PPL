<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\JadwalKuliah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KaprodiController extends Controller
{
    // Dashboard Kaprodi
    public function index()
    {
        $user = Auth::user();
        $kaprodi = $user->kaprodi; // Pastikan relasi user -> kaprodi sudah benar
        $jumlahMahasiswaAktif = $this->getMahasiswaAktif();

        return view('kaprodi.dashboard', [
            'title' => 'Dashboard Kaprodi',
            'kaprodi' => $kaprodi,
            'jumlahMahasiswaAktif' => $jumlahMahasiswaAktif,
        ]);
    }

    // Contoh fungsi tambahan untuk dashboard
    private function getMahasiswaAktif()
    {
        return Mahasiswa::where('status', 'aktif')->count();
    }

}
