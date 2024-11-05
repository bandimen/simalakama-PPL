<?php

namespace App\Http\Controllers;

use App\Models\Ruang;
use App\Models\MataKuliah;
use App\Models\JadwalKuliah;
use Illuminate\Http\Request;

class JadwalKuliahController extends Controller
{
    protected $table = 'jadwal_kuliah';
    protected $fillable = [
        'kodemk', 
        'ruang_id', 
        'kelas', 
        'hari', 
        'waktu_mulai', 
        'waktu_selesai'
    ];

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
    public function show(JadwalKuliah $jadwalKuliah)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(JadwalKuliah $jadwalKuliah)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, JadwalKuliah $jadwalKuliah)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JadwalKuliah $jadwalKuliah)
    {
        //
    }
}
