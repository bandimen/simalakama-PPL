<?php

namespace App\Http\Controllers;

use App\Models\Dekan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DekanController extends Controller
{
    public function index() {
        // data mahasiswa yg diambil di proses sessionController pas login dibawa ke view
        $user = Auth::user();
        $dekan = $user->dekan;
        $infoDekan = $dekan->dosen;
        return view('dekan.dashboard', ['title' => 'Dashboard Dekan', 'dekan' => $dekan, 'infoDekan' => $infoDekan]);
    }
    public function matkul() {
        $user = Auth::user();
        $dekan = $user->dekan;
        return view('dekan.matkul', ['title' => 'Mata Kuliah', 'dekan' => $dekan]);
    }
    public function ruangacc() {
        $user = Auth::user();
        $dekan = $user->dekan;
        return view('dekan.ruangacc', ['title' => 'Ruang Kuliah', 'dekan' => $dekan]);
    }
}
