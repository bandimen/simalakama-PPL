<?php

namespace App\Http\Controllers;

use App\Models\MataKuliah;
use App\Models\JadwalKuliah;
use Illuminate\Http\Request;
use App\Models\PengampuMataKuliah;
use Illuminate\Support\Facades\Auth;

class MataKuliahController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    // protected $table = 'mata_kuliahs';
    // protected $fillable = ['kodemk', 'nama', 'sks', 'semester', 'sifat'];

    public function index(Request $request)
    {
        $user = Auth::user();
        $prodi = $user->kaprodi?->dosen?->prodi;
        $mataKuliah = MataKuliah::where('prodi_id', $prodi->id)
        ->get();

        $query = MataKuliah::query();

        // Cek apakah ada query pencarian
        if ($request->has('search') && $request->search != '') {
            $searchTerm = $request->search;
            $query->where('nama', 'like', '%' . $searchTerm . '%')
                ->orWhere('kodemk', 'like', '%' . $searchTerm . '%');
        }

        // Ambil hasil pencarian atau semua data
        $mataKuliah = $query->get();

        return view('kaprodi.mataKuliah', compact('mataKuliah'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth::user();
        $prodi = $user->kaprodi?->dosen?->prodi;

        return view('kaprodi.tambahMataKuliah', compact('prodi'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kodemk' => 'required|unique:mata_kuliahs,kodemk|max:10',
            'nama' => 'required|max:255',
            'sks' => 'required|integer|min:1|max:6',
            'semester' => 'required|integer|min:1|max:8',
            'sifat' => 'required|in:Wajib,Pilihan',
            'prodi_id' => 'required|exists:prodis,id',
        ]);

        // Menyimpan data mata kuliah ke dalam database
        MataKuliah::create([
            'kodemk' => $request->kodemk,
            'nama' => $request->nama,
            'sks' => $request->sks,
            'semester' => $request->semester,
            'sifat' => $request->sifat,
            'prodi_id' => $request->prodi_id,
        ]);

        return redirect()->route('kaprodi.mataKuliah')->with('success', 'Mata Kuliah berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(MataKuliah $mataKuliah)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MataKuliah $mataKuliah, $id)
    {
        $mataKuliah = MataKuliah::findOrFail($id);
        $user = Auth::user();
        $prodi = $user->kaprodi?->dosen?->prodi;

        return view('kaprodi.editMataKuliah', compact('mataKuliah', 'prodi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MataKuliah $mataKuliah, $id)
    {
        $request->validate([
            'kodemk' => 'required|max:10|unique:mata_kuliahs,kodemk,' . $id . ',kodemk',
            'nama' => 'required|max:255',
            'sks' => 'required|integer|min:1|max:6',
            'semester' => 'required|integer|min:1|max:8',
            'sifat' => 'required|in:Wajib,Pilihan',
            'prodi_id' => 'required|exists:prodis,id',
        ]);

        $mataKuliah = MataKuliah::findOrFail($id);

        $mataKuliah->update([
            'kodemk' => $request->kodemk,
            'nama' => $request->nama,
            'sks' => $request->sks,
            'semester' => $request->semester,
            'sifat' => $request->sifat,
            'prodi_id' => $request->prodi_id,
        ]);

        // Redirect dengan pesan sukses
        return redirect()->route('kaprodi.mataKuliah')->with('success', 'Mata Kuliah berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($kodemk)
    {
        $mataKuliah = MataKuliah::where('kodemk', $kodemk)->first();
        $mataKuliah->delete();

        return redirect()->route('kaprodi.mataKuliah')->with('success', 'Mata Kuliah berhasil dihapus!');
    }

}
