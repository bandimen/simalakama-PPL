<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Irs;
use App\Models\IrsDetail;
use App\Models\MataKuliah;
use App\Models\JadwalKuliah;
use App\Models\Khs;
use App\Models\KhsDetails;
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

            // Tentukan jenis semester
            $jenis_semester = $semester % 2 == 0 ? 'Genap' : 'Gasal';

            // Temukan atau buat IRS mahasiswa
            $irs = Irs::firstOrCreate(
                [
                    'nim' => $mahasiswa->nim,
                    'semester' => $semester,
                    'jenis_semester' => $jenis_semester,
                    'tahun_ajaran' => $currentPeriod->tahun_ajaran,
                    'max_sks' => $mahasiswa->getMaxBebanSks(),
                ]
            );

            $irs->refresh(); // Memastikan data IRS sudah tersimpan sepenuhnya

            Log::info('IRS ID:', ['irs_id' => $irs->id]);

            $khs = Khs::firstOrCreate(
                [
                    'irs_id' => $irs->id,
                ]
            );

            Log::info('KHS Created or Retrieved:', ['khs' => $khs]);

            if (!$irs) {
                return response()->json(['message' => 'IRS tidak ditemukan untuk mahasiswa ini'], 404);
            }

            // Ambil data JSON dari request
            $bottomSheetData = $request->input('bottomSheetData', []);

            Log::info('Bottom Sheet Data Input:', $bottomSheetData);


            if (!is_array($bottomSheetData)) {
                return response()->json(['message' => 'Data tidak valid atau kosong'], 400);
            }

            // Maksimum SKS yang diizinkan
            $maxSks = $irs->max_sks; // Ambil dari database atau gunakan default
            $totalSksSaatIni = $irs->total_sks;

            // Ambil daftar kode matkul yang sudah ada di IRS
            $existingKodems = IrsDetail::where('irs_id', $irs->id)->pluck('kodemk')->toArray();

            // Hitung SKS baru dari data tambahan saja (tidak termasuk data yang sudah ada)
            $totalSksBaru = collect($bottomSheetData)
                ->reject(fn($data) => in_array($data['kodemk'], $existingKodems)) // Hanya matkul baru
                ->sum(function ($data) {
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

            // Cek apakah total SKS baru melebihi maksimum SKS
            if ($totalSksSaatIni + $totalSksBaru > $maxSks) {
                return response()->json([
                    'message' => 'Total SKS yang diambil melebihi batas maksimum',
                    'max_sks' => $maxSks,
                    'total_sks_saat_ini' => $totalSksSaatIni,
                    'sks_ditambahkan' => $totalSksBaru,
                ], 400);
            }

            // Update total SKS di IRS
            $newTotalSks = $totalSksSaatIni + $totalSksBaru;
            $irs->update(['total_sks' => $newTotalSks]);

            // Proses data baru setelah validasi berhasil
            $newDetails = collect($bottomSheetData)->map(function ($data) use ($irs, $mahasiswa) {
                $jadwalKuliah = JadwalKuliah::with('mataKuliah')
                    ->where('kodemk', $data['kodemk'])
                    ->where('kelas', $data['kelas'])
                    ->where('tahun_ajaran', '2024/2025')
                    ->first();

                $allIrsIds = Irs::where('nim', $mahasiswa->nim)->pluck('id');

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
            })->toArray();

            Log::info('isi newDetails:', $newDetails);

            foreach ($newDetails as $detail) {
                $jadwalKuliah = JadwalKuliah::find($detail['jadwal_kuliah_id']);
                
                // Pastikan jadwal kuliah ditemukan
                if (!$jadwalKuliah) {
                    return response()->json([
                        'message' => 'Jadwal kuliah tidak ditemukan untuk kodemk: ' . $detail['kodemk'],
                    ], 400);
                }
            
                // Cek apakah kuota penuh
                if ($jadwalKuliah->kuota_terpakai >= $jadwalKuliah->kuota_kelas) {
                    return response()->json([
                        'message' => 'Kuota kelas untuk mata kuliah ' . $jadwalKuliah->kodemk . ' sudah penuh.',
                    ], 400);
                }
            
                // Update atau buat IRS Detail
                $irsDetail = IrsDetail::updateOrCreate(
                    ['irs_id' => $irs->id, 'kodemk' => $detail['kodemk']],
                    $detail
                );
            
                $irsDetail->refresh(); // Memastikan data IRS sudah tersimpan sepenuhnya
            
                Log::info('IRS Detail ID:', ['irs_detail_id' => $irsDetail->id]);
            
                // Tambahkan logika untuk KHS Detail
                $khsDetail = KhsDetails::firstOrCreate(
                    [
                        'khs_id' => $khs->id, // Relasi ke KHS
                        'irs_details_id' => $irsDetail->id, // Relasi ke IRS Detail
                    ],
                    [
                        'nilai' => null, // Nilai default
                    ]
                );
            
                Log::info('KHS Detail Created or Retrieved:', ['khs_detail' => $khsDetail]);
            
                // **Tambahkan logika untuk menambah kuota terpakai hanya sekali**
                $jadwalKuliah->increment('kuota_terpakai');
            }
            
            
            return response()->json([
                'message' => 'Data IRS berhasil diperbarui',
                'newTotalSks' => $irs->total_sks,
            ], 200);
            
        } catch (\Exception $e) {
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

    public function updateTotalSks(Request $request)
{
    try {
        $user = Auth::user();
        $mahasiswa = $user->mahasiswa;

        // Cari IRS mahasiswa berdasarkan semester aktif
        $irs = Irs::where('nim', $mahasiswa->nim)
            ->where('semester', $request->input('semester'))
            ->first();

        if (!$irs) {
            return response()->json(['message' => 'IRS tidak ditemukan'], 404);
        }

        // Total SKS baru berdasarkan data yang dikirimkan
        $totalSksBaru = collect($request->input('mataKuliah', []))->sum('sks');

        // Update total SKS di IRS
        $irs->update(['total_sks' => $irs->total_sks + $totalSksBaru]);

        return response()->json([
            'message' => 'Total SKS berhasil diperbarui',
            'total_sks' => $irs->total_sks,
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'message' => 'Terjadi kesalahan',
            'error' => $e->getMessage(),
        ], 500);
    }
}

}

