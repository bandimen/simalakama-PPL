<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\MataKuliah;
use Illuminate\Http\Request;
use App\Models\PengampuMataKuliah;

class PengampuMataKuliahController extends Controller
{
    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'nidn', 'nidn');
    }

    public function mataKuliah()
    {
        return $this->belongsTo(MataKuliah::class, 'kodemk', 'kodemk');
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(PengampuMataKuliah $pengampuMataKuliah)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PengampuMataKuliah $pengampuMataKuliah)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PengampuMataKuliah $pengampuMataKuliah)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PengampuMataKuliah $pengampuMataKuliah)
    {
        //
    }
}
