<?php

namespace App\Http\Controllers;

use App\Models\MataKuliah;
use App\Models\JadwalKuliah;
use Illuminate\Http\Request;
use App\Models\PengampuMataKuliah;

class MataKuliahController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     protected $table = 'mata_kuliahs';
     protected $fillable = ['kodemk', 'nama', 'sks', 'semester', 'sifat'];
 


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
        // $request->validate([
        //     'kodemk' => 'required|string|unique:mata_kuliahs,kodemk',
        //     'nama' => 'required|string',
        //     'sks' => 'required|integer',
        //     'semester' => 'required|integer',
        //     'sifat' => 'required|in:Wajib,Pilihan',
        // ]);
    
        // MataKuliah::create([
        //     'kodemk' => $request->kodemk,
        //     'nama' => $request->nama,
        //     'sks' => $request->sks,
        //     'semester' => $request->semester,
        //     'sifat' => $request->sifat,
        // ]);
    
        // return redirect('/dekan');
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
    public function destroy(MataKuliah $mataKuliah)
    {
        //
    }
}
