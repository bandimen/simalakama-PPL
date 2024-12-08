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
            ]);

            if (!$irs) {
                return response()->json(['message' => 'IRS tidak ditemukan untuk mahasiswa ini'], 404);
            }

            // Ambil data JSON dari request
            $bottomSheetData = $request->input('bottomSheetData', []);

            if (!is_array($bottomSheetData)) {
                return response()->json(['message' => 'Data tidak valid atau kosong'], 400);
            }

            \Log::info('Processed bottomSheetData:', $bottomSheetData); // Debug log

            // Jika bottomSheetData kosong, hapus semua data terkait dengan irs_id
            if (empty($bottomSheetData)) {
                IrsDetail::where('irs_id', $irs->id)->delete();
                \Log::info("Semua data terkait dengan IRS ID '{$irs->id}' telah dihapus karena bottomSheetData kosong.");
                return response()->json(['message' => 'IRS berhasil diperbarui dan semua data dihapus'], 200);
            }

            // Ambil data saat ini dari database
            $existingDetails = IrsDetail::where('irs_id', $irs->id)->get();

            // Hapus entri duplikat dalam bottomSheetData
            $uniqueBottomSheetData = collect($bottomSheetData)->unique(function ($item) {
                return $item['kodemk'] . $item['kelas'];
            });

            // Hitung total SKS yang akan ditambahkan
            $totalSksBaru = collect($uniqueBottomSheetData)->sum(function ($data) {
                $jadwalKuliah = JadwalKuliah::with('mataKuliah')
                    ->where('kodemk', $data['kodemk'])
                    ->where('kelas', $data['kelas'])
                    ->where('tahun_ajaran', '2024/2025')
                    ->first();

                if (!$jadwalKuliah || !$jadwalKuliah->mataKuliah) {
                    throw new \Exception("Jadwal tidak ditemukan atau tidak valid untuk kodemk: {$data['kodemk']}, kelas: {$data['kelas']}");
                }

                return $jadwalKuliah->mataKuliah->sks;
            });

            // Perbarui total SKS di IRS
            $irs->update(['total_sks' => $totalSksBaru]);

            // Data yang baru ditambahkan
            $newDetails = $uniqueBottomSheetData->map(function ($data) use ($irs, $mahasiswa) {
                $jadwalKuliah = JadwalKuliah::with('mataKuliah')
                    ->where('kodemk', $data['kodemk'])
                    ->where('kelas', $data['kelas'])
                    ->where('tahun_ajaran', '2024/2025')
                    ->first();

                // Temukan semua IRS mahasiswa (semua semester)
                $allIrsIds = Irs::where('nim', $mahasiswa->nim)->pluck('id');

                // Cek apakah matakuliah sudah pernah diambil
                $previousIrsDetail = IrsDetail::whereIn('irs_id', $allIrsIds)
                    ->whereHas('khsDetails', fn($query) => $query->where('kodemk', $data['kodemk']))
                    ->orderBy('created_at', 'desc')
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

