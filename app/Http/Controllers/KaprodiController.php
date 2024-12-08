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
        $user = Auth::user()->load('kaprodi.dosen.prodi'); // Eager loading relasi
        $prodi = $user->kaprodi?->dosen?->prodi; // Ambil nama prodi dari relasi
        $jumlahMahasiswaAktif = $user->kaprodi?->getMahasiswaAktif() ?? 0;
        $jumlahDosen = $user->kaprodi?->getDosen() ?? 0;

        return view('kaprodi.dashboard', [
            'title' => 'Dashboard Kaprodi',
            'prodiNama' => $prodi?->nama ?? 'Prodi tidak ditemukan',
            'jumlahMahasiswaAktif' => $jumlahMahasiswaAktif,
            'jumlahDosen' => $jumlahDosen
        ]);
    }

}
