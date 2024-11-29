<?php

namespace App\Http\Controllers;

use App\Models\Dekan;
use App\Models\JadwalKuliah;
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
    public function jadwalKuliah()
    {
        // Ambil jadwal yang belum disetujui
        $jadwalKuliah = JadwalKuliah::with(['mataKuliah', 'ruang'])
            ->where('status', 'Belum disetujui')
            ->get();
            

        return view('dekan.matkul', compact('jadwalKuliah'));
    }

    public function approveJadwalKuliah($id)
    {
        // Temukan jadwal dan ubah status menjadi 'Disetujui'
        $jadwalKuliah = JadwalKuliah::findOrFail($id);
        $jadwalKuliah->update(['status' => 'Disetujui']);

        return redirect()->route('dekan.matkul')
            ->with('success', 'Jadwal kuliah berhasil disetujui!');
    }
}
