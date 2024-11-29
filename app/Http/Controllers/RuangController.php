<?php

namespace App\Http\Controllers;

use App\Models\Prodi;
use App\Models\Ruang;
use App\Models\JadwalKuliah;
use Illuminate\Http\Request;

class RuangController extends Controller
{

    // Relasi ke JadwalKuliah
    public function jadwalKuliah()
    {
        return $this->hasMany(JadwalKuliah::class, 'ruang_id', 'id');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    $prodi = Prodi::all(); // Mengambil semua data program studi
    $ruangs = Ruang::with('prodi')->get(); // Mengambil semua data ruangan dengan relasi prodi
    return view('akademik.tambahruang', compact('prodi', 'ruangs'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    $prodi = Prodi::all(); // Mengambil semua data program studi
    $ruangs = Ruang::with('prodi')->get(); // Mengambil semua data ruangan dengan prodi
    return view('akademik.tambahruang', compact('prodi', 'ruangs'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $request->validate([
        'nama' => 'required|unique:ruangs|max:255',
        'gedung' => 'required|max:1',
        'kapasitas' => 'required|integer|min:1',
        'prodi_id' => 'required|exists:prodis,id',
    ]);

    // Cek apakah ruangan sudah di-plot untuk prodi tertentu
    $exists = Ruang::where('nama', $request->nama)
                    ->where('prodi_id', $request->prodi_id)
                    ->exists();

    if ($exists) {
        return redirect()->back()->with('error', 'Ruangan sudah di-plot untuk program studi ini.');
    }

    // Jika belum ada, tambahkan ruangan baru
    Ruang::create([
        'nama' => $request->nama,
        'gedung' => $request->gedung,
        'kapasitas' => $request->kapasitas,
        'prodi_id' => $request->prodi_id,
        'status' => 'belum disetujui',
    ]);

    return redirect()->back()->with('success', 'Ruangan berhasil ditambahkan dan menunggu persetujuan.');
}



    /**
     * Display the specified resource.
     */
    public function show(Ruang $ruang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ruang $ruang)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    
    public function update(Request $request, Ruang $ruang)
    {
        //
    }
    public function verifikasi()
    {
        // Ambil ruangan yang belum disetujui
        $ruangs = Ruang::where('status', 'Belum disetujui')->with('prodi')->get();

        // Kirim data ke view
        return view('dekan.ruangacc', compact('ruangs'));
    }

    /**
     * Menyetujui ruangan.
     */
    public function approve($id)
    {
        // Temukan ruangan berdasarkan ID
        $ruang = Ruang::findOrFail($id);

       

        // Ubah status ruangan menjadi "Disetujui"
        $ruang->update(['status' => 'Disetujui']);

        

        // Redirect dengan pesan sukses
        return redirect()->route('ruangs.verifikasi')->with('success', 'Ruangan berhasil disetujui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ruang $ruang)
{
    $ruang->delete();

    return redirect()->back()->with('success', 'Ruangan berhasil dihapus.');
}

}
