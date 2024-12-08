<?php

namespace App\Http\Controllers;

use App\Models\Dekan;
use App\Models\Prodi;

use Illuminate\Routing\Controller;
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
                // Ambil semua prodi beserta jadwal kuliah yang belum disetujui
        $prodis = Prodi::with(['mataKuliah.jadwalKuliah' => function ($query) {
            $query->where('status', 'Belum disetujui'); // Filter jadwal dengan status "Belum disetujui"
        }])->get();
        return view('dekan.matkul', ['title' => 'Mata Kuliah', 'dekan' => $dekan, 'prodis' => $prodis]);
    }
    public function ruangacc() {
        $user = Auth::user();
        $dekan = $user->dekan;
        return view('dekan.ruangacc', ['title' => 'Ruang Kuliah', 'dekan' => $dekan]);
    }
    public function verifikasi()
    {
        // Ambil semua prodi beserta jadwal kuliah yang belum disetujui
        $prodis = Prodi::with(['mataKuliah.jadwalKuliah ' => function ($query) {
            $query->where('status', 'Belum disetujui'); // Filter jadwal dengan status "Belum disetujui"
        }])->get();
        
        return view('dekan.matkul', compact('prodis'));
    }

    public function approveAll($prodiId)
    {
        // Ambil Prodi berdasarkan ID
        $prodi = Prodi::with(['mataKuliah.jadwalKuliah' => function ($query) {
            $query->where('status', 'Belum disetujui');
        }])->findOrFail($prodiId);

        // Setujui semua jadwal kuliah dalam Prodi tersebut
        $prodi->mataKuliah->each(function ($mataKuliah) {
            $mataKuliah->jadwalKuliah->each(function ($jadwal) {
                $jadwal->update(['status' => 'Disetujui']);
            });
        });

        return redirect()->route('dekan.matkul')
            ->with('success', 'Semua jadwal kuliah di Prodi ' . $prodi->nama . ' berhasil disetujui.');
    }

}
