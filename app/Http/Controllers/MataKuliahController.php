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

    protected $table = 'mata_kuliahs';
    protected $fillable = ['kodemk', 'nama', 'sks', 'semester', 'sifat'];

    public function index(Request $request)
    {
        $user = Auth::user();
        $prodi = $user->kaprodi?->dosen?->prodi;
        $mataKuliah = MataKuliah::where('prodi_id', $prodi->id)->get();

        return view('kaprodi.mataKuliah', compact('mataKuliah'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth::user();
        $prodi = $user->kaprodi?->dosen?->prodi;

        return view('kaprodi.tambahMataKuliah', ['prodi' => $prodi]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kodemk' => 'required|unique:matakuliah,kodemk',
            'nama' => 'required',
            'sks' => 'required|integer',
            'semester' => 'required',
            'sifat' => 'required',
            'prodi_id' => 'required|exists:prodi,id',
        ]);

        MataKuliah::create($request->all());

        return redirect()->route('kaprodi.mataKuliah')->with('success', 'Mata Kuliah berhasil ditambahkan!');
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
    public function edit(MataKuliah $mataKuliah)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MataKuliah $mataKuliah)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($kodemk)
{
    $mataKuliah = MataKuliah::findOrFail($kodemk);
    $mataKuliah->delete();

    return redirect()->route('kaprodi.mataKuliah')->with('success', 'Mata Kuliah berhasil dihapus!');
}

}
