<?php

namespace App\Http\Controllers;

use App\Models\Irs;
use App\Models\IrsDetail;
use App\Models\JadwalKuliah;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\IrsPeriodsController;

class ProgressController extends Controller
{
    public function save(Request $request)
    {
        try {
            $user = Auth::user(); // Mahasiswa yang login
            $mahasiswa = $user->mahasiswa;
    
            // Ambil periode dan semester aktif
            $currentPeriod = (new IrsPeriodsController())->getCurrentPeriod();
            $semester = (new MahasiswaController())->getSemester($mahasiswa->angkatan, $currentPeriod);
    
            // Temukan IRS mahasiswa
            $irs = Irs::firstOrCreate(
                ['nim' => $mahasiswa->nim, 'semester' => $semester],
                ['status' => 'Draft']
            );
    
            // Hapus data lama di IrsDetail terkait IRS ini
            IrsDetail::where('irs_id', $irs->id)->delete();
    
            // Simpan data baru ke IrsDetail
            $bottomSheetData = $request->input('bottomSheetData', []);
            foreach ($bottomSheetData as $data) {
                $jadwalKuliah = JadwalKuliah::where('kodemk', $data['kodemk'])
                    ->where('kelas', $data['kelas'])
                    ->first();
    
                if (!$jadwalKuliah) {
                    return response()->json(['message' => "Jadwal tidak ditemukan untuk kodemk: {$data['kodemk']} dan kelas: {$data['kelas']}"], 404);
                }
    
                IrsDetail::create([
                    'irs_id' => $irs->id,
                    'kodemk' => $data['kodemk'],
                    'jadwal_kuliah_id' => $jadwalKuliah->id,
                    'status' => 'Baru',
                ]);
            }
    
            return response()->json(['message' => 'Progress saved successfully'], 200);
        } catch (\Exception $e) {
            \Log::error('Error saving progress:', ['error' => $e->getMessage()]);
            return response()->json(['message' => 'Terjadi kesalahan saat menyimpan progres', 'error' => $e->getMessage()], 500);
        }
    }
    
     
    public function load()
    {
        try {
            $user = Auth::user(); // Mahasiswa yang login
            $mahasiswa = $user->mahasiswa;
    
            // Ambil periode dan semester aktif
            $currentPeriod = (new IrsPeriodsController())->getCurrentPeriod();
            $semester = (new MahasiswaController())->getSemester($mahasiswa->angkatan, $currentPeriod);
    
            // Temukan IRS berdasarkan NIM dan semester
            $irs = Irs::where('nim', $mahasiswa->nim)
                ->where('semester', $semester)
                ->first();
    
            if (!$irs) {
                return response()->json(['message' => 'IRS tidak ditemukan untuk mahasiswa ini'], 404);
            }
    
            // Ambil data IrsDetail yang terkait dengan IRS ini
            $irsDetails = IrsDetail::where('irs_id', $irs->id)->get();
    
            // Format data untuk dikirim ke frontend
            $progress = $irsDetails->map(function ($detail) {
                return [
                    'kodemk' => $detail->kodemk,
                    'kelas' => $detail->jadwalKuliah->kelas,
                    'mataKuliah' => $detail->jadwalKuliah->mataKuliah->nama,
                    'hari' => $detail->jadwalKuliah->hari,
                    'jam' => "{$detail->jadwalKuliah->waktu_mulai} - {$detail->jadwalKuliah->waktu_selesai}",
                ];
            });
    
            return response()->json(['bottomSheetData' => $progress], 200);
        } catch (\Exception $e) {
            \Log::error('Error loading progress:', ['error' => $e->getMessage()]);
            return response()->json(['message' => 'Terjadi kesalahan saat memuat progres', 'error' => $e->getMessage()], 500);
        }
    }
    
    
}
