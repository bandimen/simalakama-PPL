<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Irs;
use App\Models\IrsDetail;
use App\Models\MataKuliah;
use App\Models\JadwalKuliah;
use Illuminate\Support\Facades\Log;

class IrsDetailController extends Controller
{
    public function store(Request $request)
{
    $user = Auth::user();
    $mahasiswa = $user->mahasiswa;

    // Hitung semester mahasiswa berdasarkan angkatan dan periode saat ini
    $irsPeriodsController = new IrsPeriodsController();
    $currentPeriod = $irsPeriodsController->getCurrentPeriod();
    $mahasiswaController = new MahasiswaController();
    $semester = $mahasiswaController->getSemester($mahasiswa->angkatan, $currentPeriod);

    // Temukan IRS mahasiswa
    $irs = Irs::where('nim', $mahasiswa->nim)
        ->where('semester', $semester)
        ->first();

    if (!$irs) {
        return response()->json(['message' => 'IRS tidak ditemukan untuk mahasiswa ini'], 404);
    }

    // Ambil data JSON dari request
    $bottomSheetData = $request->input('bottomSheetData');

    if (!$bottomSheetData || !is_array($bottomSheetData)) {
        return response()->json(['message' => 'Data tidak valid atau kosong'], 400);
    }

    foreach ($bottomSheetData as $data) {
        $kodemk = $data['kodemk'];
        $kelas = $data['kelas'];

        // Hapus entri yang lama untuk kodemk ini
        IrsDetail::where('irs_id', $irs->id)
            ->where('kodemk', $kodemk)
            ->delete();

        // Cari jadwal kuliah berdasarkan kodemk dan kelas
        $jadwalKuliah = JadwalKuliah::where('kodemk', $kodemk)
            ->where('kelas', $kelas)
            ->first();

        if (!$jadwalKuliah) {
            return response()->json(['message' => "Jadwal tidak ditemukan untuk $kodemk"], 400);
        }

        // Tambahkan data baru ke IRS Detail
        IrsDetail::create([
            'irs_id' => $irs->id,
            'kodemk' => $kodemk,
            'jadwal_kuliah_id' => $jadwalKuliah->id,
            'status' => 'Baru',
        ]);
    }

    return response()->json(['message' => 'Data IRS berhasil diperbarui'], 200);
}

    

    public function saveSelectedCourse(Request $request)
    {
        $user = Auth::user();
        $mahasiswa = $user->mahasiswa;
        $irs = Irs::where('nim', $mahasiswa->nim)->where('semester', $request->semester)->first();

        if (!$irs) {
            return response()->json(['message' => 'IRS tidak ditemukan'], 404);
        }

        $existing = IrsDetail::where('irs_id', $irs->id)->where('kodemk', $request->kodemk)->first();

        if (!$existing) {
            IrsDetail::create([
                'irs_id' => $irs->id,
                'kodemk' => $request->kodemk,
                'kelas' => $request->kelas,
            ]);
        }

        return response()->json(['message' => 'Mata kuliah berhasil disimpan']);
    }
}

