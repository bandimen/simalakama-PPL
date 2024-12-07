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
        try {
            $user = Auth::user();
            $mahasiswa = $user->mahasiswa;
    
            // Hitung semester mahasiswa berdasarkan angkatan dan periode saat ini
            $irsPeriodsController = new IrsPeriodsController();
            $currentPeriod = $irsPeriodsController->getCurrentPeriod();
            $mahasiswaController = new MahasiswaController();
            $semester = $mahasiswaController->getSemester($mahasiswa->angkatan, $currentPeriod);
    
            \Log::info('Request received:', $request->all()); // Debug log
    
            // Tentukan jenis semester
            $jenis_semester = $semester % 2 == 0 ? 'Genap' : 'Gasal';

            // Temukan atau buat IRS mahasiswa
            $irs = Irs::firstOrCreate([
                'nim' => $mahasiswa->nim,
                'semester' => $semester,
                'jenis_semester' => $jenis_semester,
                'tahun_ajaran' => '2024/2025',
                // 'tahun_ajaran' => $currentPeriod->tahun_ajaran,
            ]);

            if ($irs->wasRecentlyCreated()) {
                Khs::firstOrCreate(['irs_id' => $irs->id]);
            }
    
            if (!$irs) {
                return response()->json(['message' => 'IRS tidak ditemukan untuk mahasiswa ini'], 404);
            }
    
            // Ambil data JSON dari request
            $bottomSheetData = $request->input('bottomSheetData', []);
    
            if (!is_array($bottomSheetData)) {
                return response()->json(['message' => 'Data tidak valid atau kosong'], 400);
            }
    
            \Log::info('Processed bottomSheetData:', $bottomSheetData); // Debug log
    
            // Jika `bottomSheetData` kosong, hapus semua data terkait dengan `irs_id`
            if (empty($bottomSheetData)) {
                // Hapus semua entri yang terkait dengan IRS ID
                IrsDetail::where('irs_id', $irs->id)->delete();
    
                \Log::info("Semua data terkait dengan IRS ID '{$irs->id}' telah dihapus karena bottomSheetData kosong.");
                return response()->json(['message' => 'IRS berhasil diperbarui dan semua data dihapus'], 200);
            }
    
            // Ambil data saat ini dari database
            $existingDetails = IrsDetail::where('irs_id', $irs->id)->get();
    
            // Data yang baru ditambahkan
            $newDetails = collect($bottomSheetData)->map(function ($data) use ($irs, $mahasiswa) {
                if (empty($data['kodemk']) || empty($data['kelas'])) {
                    throw new \Exception('Format data tidak valid: kodemk dan kelas wajib ada');
                }

                $jadwalKuliah = JadwalKuliah::where('kodemk', $data['kodemk'])
                    ->where('kelas', $data['kelas'])
                    ->where('tahun_ajaran', '2024/2025')
                    // 'tahun_ajaran' => $currentPeriod->tahun_ajaran,
                    ->first();

                if (!$jadwalKuliah) {
                    throw new \Exception("Jadwal tidak ditemukan untuk kodemk: {$data['kodemk']}, kelas: {$data['kelas']}");
                }

                // Temukan semua IRS mahasiswa (semua semester)
                $allIrsIds = Irs::where('nim', $mahasiswa->nim)->pluck('id');

                // Cek apakah matakuliah sudah pernah diambil
                $previousIrsDetail = IrsDetail::whereIn('irs_id', $allIrsIds) // Cari di semua IRS mahasiswa
                    ->whereHas('khsDetails', fn($query) => $query->where('kodemk', $data['kodemk'])) // Cocokkan kodemk
                    ->orderBy('created_at', 'desc') // Ambil data terbaru
                    ->first();

                $status = 'Baru';
                if ($previousIrsDetail) {
                    $khsDetail = $previousIrsDetail->khsDetails()->latest()->first();
                    $nilai = $khsDetail->nilai ?? null;
                    $status = match ($nilai) {
                        'B', 'C', 'D' => 'Perbaikan',
                        'E' => 'Ulang',
                        default => 'Baru',
                    };
                }

                return [
                    'irs_id' => $irs->id,
                    'kodemk' => $data['kodemk'],
                    'jadwal_kuliah_id' => $jadwalKuliah->id,
                    'status' => $status,
                ];
            });

            // Hapus entri yang tidak ada di bottomSheetData
            $existingKodems = $existingDetails->pluck('kodemk')->toArray();
            $newKodems = $newDetails->pluck('kodemk')->toArray();
    
            $kodemsToDelete = array_diff($existingKodems, $newKodems);
    
            IrsDetail::where('irs_id', $irs->id)
                ->whereIn('kodemk', $kodemsToDelete)
                ->delete();
    
            // Tambahkan atau perbarui entri di database
            foreach ($newDetails as $detail) {
                IrsDetail::updateOrCreate(
                    ['irs_id' => $irs->id, 'kodemk' => $detail['kodemk']],
                    $detail
                );
            }
    
            return response()->json(['message' => 'Data IRS berhasil diperbarui'], 200);
        } catch (\Exception $e) {
            \Log::error('Error processing IRS store:', ['error' => $e->getMessage()]);
            return response()->json(['message' => 'Terjadi kesalahan saat memproses data', 'error' => $e->getMessage()], 500);
        }
    }  
    
    public function delete($id)
    {
        // Pastikan data ada sebelum dihapus
        $irsDetail = IrsDetail::find($id);
    
        if ($irsDetail) {
            $irsDetail->delete(); // Hapus data
        }
    
        // Redirect kembali ke halaman sebelumnya
        return redirect()->back();
    }
}

