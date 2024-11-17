<?php

namespace App\Http\Controllers;

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
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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

    Ruang::create([
        'nama' => $request->nama,
        'gedung' => $request->gedung,
        'kapasitas' => $request->kapasitas,
        'prodi_id' => $request->prodi_id,
    ]);

    return redirect()->back()->with('success', 'Ruangan berhasil ditambahkan.');
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ruang $ruang)
    {
        //
    }
}
