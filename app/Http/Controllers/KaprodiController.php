<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KaprodiController extends Controller
{
    public function index() {
        $user = Auth::user();
        $kaprodi = $user->kaprodi;
        $jumlahMahasiswaAktif = $this->getMahasiswaAktif();

        return view('kaprodi.dashboard', [
            'title' => 'Dashboard Kaprodi',
            'kaprodi' => $kaprodi,
            'jumlahMahasiswaAktif' => $jumlahMahasiswaAktif,
        ]);
    }

    public function getMahasiswaAktif() {
        return Mahasiswa::where('status', 'aktif')->count();
    }

}
