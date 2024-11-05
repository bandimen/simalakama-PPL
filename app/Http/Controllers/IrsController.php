<?php

namespace App\Http\Controllers;

use App\Models\Irs;
use App\Models\IrsDetail;
use App\Models\JadwalKuliah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Ui\AuthRouteMethods;

class IrsController extends Controller
{
    public function store(Request $request)
    {
        
        $request->validate([
            'nim' => 'required|string',
            'semester' => 'required|integer',
            'tahun_ajaran' => 'required|string',
            'total_sks' => 'required|integer',
            'jadwal' => 'required|array' 
        ]);
    
        try {
            // Buat IRS baru
            // $irs = new IRS();
            // $irs->nim = $request->nim;
            // $irs->semester = $request->semester;
            // $irs->tahun_ajaran = $request->tahun_ajaran;
            // $irs->total_sks = $request->total_sks;
            // $irs->save();

            $irs = Irs::firstorCreate([
                'nim' => $request->nim,
                'semester' => $request->semester,
                'tahun_ajaran' => $request->tahun_ajaran,
                'total_sks' => $request->total_sks,
            ]);


    
            // Simpan detail IRS
            foreach ($request->jadwal as $item) {
                IrsDetail::create([
                    'irs_id' => $irs->id,
                    'kodemk' => $item['kodemk'],
                    'jadwal_kuliah_id' => $item['jadwal_kuliah_id'],
                    'status' => $item['status'] ?? 'baru'
                ]);
            }
            
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()], 500);
        }
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
     * Display the specified resource.
     */
    public function show(Irs $irs)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Irs $irs)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Irs $irs)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Irs $irs)
    {
        //
    }
}
