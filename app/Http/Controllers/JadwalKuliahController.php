<?php

namespace App\Http\Controllers;

use App\Models\Ruang;
use App\Models\MataKuliah;
use App\Models\JadwalKuliah;
use Illuminate\Http\Request;

class JadwalKuliahController extends Controller
{

    // Relasi ke MataKuliah
    public function mataKuliah()
    {
        return $this->belongsTo(MataKuliah::class, 'kodemk', 'kodemk');
    }

    // Relasi ke Ruang
    public function ruang()
    {
        return $this->belongsTo(Ruang::class, 'ruang_id', 'id');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jadwalKuliah = JadwalKuliah::with(['mataKuliah', 'ruang'])->get();
        return view('kaprodi.jadwalKuliah', compact('jadwalKuliah'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $currentYear = date('Y');
        $semester = (date('n') <= 6) ? 'genap' : 'ganjil';

        // Filter mata kuliah berdasarkan semester
        $mataKuliah = MataKuliah::where('semester', $semester === 'ganjil' ? 1 : 2)->get();

        // Ambil ruang yang tersedia
        $ruang = Ruang::all();

        // Data dropdown lainnya
        $kelas = ['A', 'B', 'C', 'D'];
        $hari = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat'];
        $waktuMulai = ['07:00', '09:40', '13:00', '15:40'];

        return view('kaprodi.tambahJadwal', compact('mataKuliah', 'ruang', 'kelas', 'hari', 'waktuMulai'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kodemk' => 'required',
            'ruang_id' => 'required',
            'kelas' => 'required|in:A,B,C,D',
            'hari' => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat',
            'waktu_mulai' => 'required',
        ]);

        // Ambil data mata kuliah untuk menghitung waktu selesai
        $mataKuliah = MataKuliah::where('kodemk', $request->kodemk)->first();
        $waktuSelesai = date('H:i', strtotime($request->waktu_mulai) + $mataKuliah->sks * 50 * 60);

        // Periksa batas 4 kelas untuk mata kuliah
        $existingClasses = JadwalKuliah::where('kodemk', $request->kodemk)->distinct('kelas')->count();
        if ($existingClasses >= 4) {
            return redirect()->back()->withErrors(['kodemk' => 'Mata kuliah ini sudah memiliki 4 jadwal berbeda.']);
        }

        // Simpan jadwal
        JadwalKuliah::create([
            'kodemk' => $request->kodemk,
            'ruang_id' => $request->ruang_id,
            'kelas' => $request->kelas,
            'hari' => $request->hari,
            'waktu_mulai' => $request->waktu_mulai,
            'waktu_selesai' => $waktuSelesai,
            'kuota_kelas' => $request->kuota_kelas,
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
        $jadwalKuliah = JadwalKuliah::findOrFail($id);
        $mataKuliah = MataKuliah::all();
        $ruang = Ruang::all();
        $kelas = ['A', 'B', 'C', 'D'];
        $hari = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat'];

        return view('kaprodi.editJadwal', compact('jadwalKuliah', 'mataKuliah', 'ruang', 'kelas', 'hari'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'kodemk' => 'required',
            'ruang_id' => 'required',
            'kelas' => 'required|in:A,B,C,D',
            'hari' => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat',
            'waktu_mulai' => 'required',
            'waktu_selesai' => 'required|after:waktu_mulai',
            'kuota_kelas' => 'required|numeric|min:0',
        ]);

        $jadwal = JadwalKuliah::findOrFail($id);
        $jadwal->update($request->all());

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
