<?php

namespace App\Http\Controllers;

use App\Models\Ruang;
use App\Models\MataKuliah;
use App\Models\JadwalKuliah;
use App\Models\IrsPeriods;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JadwalKuliahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $irsPeriodsController = new IrsPeriodsController();
        $currentPeriod = $irsPeriodsController->getCurrentPeriod();

        $user = Auth::user();
        $prodi = $user->kaprodi?->dosen?->prodi;
        $search = $request->input('search');
        $jadwalKuliah = JadwalKuliah::whereHas('matakuliah', function ($query) use ($prodi) {
            $query->where('prodi_id', $prodi->id);
        })
        ->where('tahun_ajaran', $currentPeriod->tahun_ajaran)
        ->search($search)
        ->get();

        return view('kaprodi.jadwalKuliah', compact('jadwalKuliah'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $user = Auth::user();
        // $currentYear = date('Y');
        // $semester = (date('n') <= 6) ? 'genap' : 'ganjil';
        $irsPeriodsController = new IrsPeriodsController();
        $currentPeriod = $irsPeriodsController->getCurrentPeriod();

        $semester = $currentPeriod->semester;

        $prodi = $user->kaprodi?->dosen?->prodi;
        $mataKuliah = null;
        if ($currentPeriod) {
            // ini ambil mata kuliah yang punya jadwal dan sudah disetujui
            if ($currentPeriod->semester == 'Gasal') {
                $mataKuliah = MataKuliah::where(function ($query) {
                    $query->where('semester', 0)
                        ->orWhereRaw('semester % 2 != 0');
                    })
                ->where('prodi_id', $prodi->id)
                ->orderBy('semester', 'asc')
                ->get();
            } elseif ($currentPeriod->semester == 'Genap') {
                $mataKuliah = MataKuliah::whereRaw('semester % 2 = 0')
                    ->where('prodi_id', $prodi->id)
                    ->orderBy('semester', 'asc')
                    ->get();
            }
        }
        // Ambil ruang yang tersedia
        $ruang = Ruang::where('status', 'Disetujui')->get();
        $kuota_kelas = Ruang::where('kapasitas')->get();
        $tahun_ajaran = IrsPeriods::latest()->first()?->periode ?? '2024/2025';

        // Data dropdown lainnya
        $kelas = ['A', 'B', 'C', 'D'];
        $hari = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Belum dijadwalkan'];
        $waktu_mulai = ['07:00', '09:40', '13:00', '15:40'];

        $jadwalTerpakai = JadwalKuliah::select('kelas', 'hari', 'waktu_mulai', 'ruang_id')
            ->get()
            ->groupBy('kelas')
            ->map(function ($items) {
                return $items->groupBy('hari');
            });

        return view('kaprodi.tambahJadwal', compact('mataKuliah', 'ruang', 'kelas', 'hari', 'tahun_ajaran', 'kuota_kelas', 'waktu_mulai', 'jadwalTerpakai'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kodemk' => 'required|exists:mata_kuliahs,kodemk',
            'ruang_id' => 'required|exists:ruangs,id',
            'kelas' => 'required|string',
            'hari' => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat',
            'tahun_ajaran' => 'required|string',
            'kuota_kelas' => 'required|integer|min:30',
            'waktu_mulai' => 'required|date_format:H:i',
            'waktu_selesai' => 'required|date_format:H:i|after:waktu_mulai',
        ]);

        // Ambil data mata kuliah untuk menghitung waktu selesai
        $mataKuliah = MataKuliah::where('kodemk', $request->kodemk)->first();
        $waktuSelesai = date('H:i', strtotime($request->waktu_mulai) + $mataKuliah->sks * 50 * 60);

        // Periksa batas 4 kelas untuk mata kuliah
        $existingClasses = JadwalKuliah::where('kodemk', $request->kodemk)->distinct('kelas')->count();
        if ($existingClasses >= 4) {
            return redirect()->back()->withErrors(['kodemk' => 'Mata kuliah ini sudah memiliki 4 jadwal berbeda.']);
        }

        // Cek apakah ada jadwal yang tumpang tindih di hari, ruang, dan waktu yang sama
        $existingSchedule = JadwalKuliah::where('kelas', $request->kelas)
            ->where('ruang_id', $request->ruang_id)
            ->where('hari', $request->hari)
            ->where('waktu_mulai', $request->waktu_mulai)
            ->exists();

        if ($existingSchedule) {
        return redirect()->back()
            ->withInput($request->all())
            ->withErrors([
                'jadwal_bentrok' => 'Tidak dapat menambahkan jadwal. Ruangan sudah digunakan pada waktu tersebut di hari yang sama.'
            ]);
        }

        // Simpan jadwal
        JadwalKuliah::create([
            'kodemk' => $request->kodemk,
            'ruang_id' => $request->ruang_id,
            'kelas' => $request->kelas,
            'hari' => $request->hari,
            'tahun_ajaran' => $request->tahun_ajaran,
            'kuota_kelas' => $request->kuota_kelas,
            'waktu_mulai' => $request->waktu_mulai,
            'waktu_selesai' => $waktuSelesai,
            'status' => 'Belum disetujui',
        ]);

        return redirect()->route('kaprodi.jadwalKuliah')->with('success', 'Jadwal berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(JadwalKuliah $jadwalKuliah)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $jadwalKuliah = JadwalKuliah::find($id);

        $user = Auth::user();
        $prodi = $user->kaprodi?->dosen?->prodi;

        $currentYear = date('Y');
        $semester = (date('n') <= 6) ? 'genap' : 'ganjil';

        // Filter mata kuliah berdasarkan semester
        $mataKuliah = MataKuliah::where('prodi_id', $prodi->id)
                                ->where('semester', $semester === 'ganjil' ? 1 : 2)
                                ->get();

        $tahun_ajaran = IrsPeriods::latest()->first()?->periode ?? '2024/2025';
        $ruang = Ruang::where('status', 'Disetujui')->get();
        $kuota_kelas = Ruang::where('kapasitas')->get();
        $kelas = ['A', 'B', 'C', 'D'];
        $hari = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat'];
        $waktu_mulai = ['07:00', '09:40', '13:00', '15:40'];

        // Mengambil nilai waktu selesai berdasarkan waktu mulai dan durasi SKS
        $mataKuliahSks = MataKuliah::where('kodemk', $jadwalKuliah->kodemk)->first()?->sks;
        $waktuSelesai = date('H:i', strtotime($jadwalKuliah->waktu_mulai) + $mataKuliahSks * 50 * 60);

        // Get existing jadwals for the selected kelas
        $existingJadwals = JadwalKuliah::where('kelas', $jadwalKuliah->kelas)
                                        ->where('hari', $jadwalKuliah->hari)
                                        ->where('waktu_mulai', $jadwalKuliah->waktu_mulai)
                                        ->get();

        $jadwalTerpakai = JadwalKuliah::select('kelas', 'hari', 'waktu_mulai', 'ruang_id')
            ->get()
            ->groupBy('kelas')
            ->map(function ($items) {
                return $items->groupBy('hari');
            });

        return view('kaprodi.editJadwal', compact('jadwalKuliah', 'mataKuliah', 'ruang', 'kelas', 'hari', 'tahun_ajaran','kuota_kelas', 'waktu_mulai', 'waktuSelesai', 'existingJadwals', 'jadwalTerpakai'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'kodemk' => 'required|exists:mata_kuliahs,kodemk',
            'ruang_id' => 'required|exists:ruangs,id',
            'kelas' => 'required|string|max:1',
            'hari' => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat',
            'tahun_ajaran' => 'required|string',
            'kuota_kelas' => 'required|integer|min:30',
            'waktu_mulai' => 'required|date_format:H:i',
            'waktu_selesai' => 'required|date_format:H:i|after:waktu_mulai',
        ]);

        $jadwalKuliah = JadwalKuliah::findOrFail($id);

        // Ambil data mata kuliah untuk menghitung waktu selesai
        $mataKuliahSks = MataKuliah::where('kodemk', $jadwalKuliah->kodemk)->first()?->sks;
        $waktuSelesai = date('H:i', strtotime($jadwalKuliah->waktu_mulai) + $mataKuliahSks * 50 * 60);

        // Cek apakah ada jadwal yang tumpang tindih untuk update
        $existingSchedule = JadwalKuliah::where('kelas', $request->kelas)
            ->where('ruang_id', $request->ruang_id)
            ->where('hari', $request->hari)
            ->where('waktu_mulai', $request->waktu_mulai)
            ->where('id', '!=', $id)  // Mengecualikan jadwal yang sedang diupdate
            ->exists();

        if ($existingSchedule) {
        return redirect()->back()
            ->withInput($request->all())
            ->withErrors([
                'jadwal_bentrok' => 'Jadwal bentrok dengan jadwal yang sudah ada.'
            ]);
        }

        // Periksa batas 4 kelas untuk mata kuliah
        $existingClasses = JadwalKuliah::where('kodemk', $request->kodemk)->distinct('kelas')->count();
        if ($existingClasses >= 4) {
            return redirect()->back()->withErrors(['kodemk' => 'Mata kuliah ini sudah memiliki 4 jadwal berbeda.']);
        }

        $jadwalKuliah->update([
            'kodemk' => $request->kodemk,
            'ruang_id' => $request->ruang_id,
            'kelas' => $request->kelas,
            'hari' => $request->hari,
            'tahun_ajaran' => $request->tahun_ajaran,
            'kuota_kelas' => $request->kuota_kelas,
            'waktu_mulai' => $request->waktu_mulai,
            'waktu_selesai' => $waktuSelesai,
            'status' => 'Belum disetujui',
        ]);

        return redirect()->route('kaprodi.jadwalKuliah')->with('success', 'Jadwal berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $jadwal = JadwalKuliah::findOrFail($id);
        $jadwal->delete();
        return redirect()->route('kaprodi.jadwalKuliah')->with('success', 'Jadwal kuliah berhasil dihapus.');
    }
}
