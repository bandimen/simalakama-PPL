<?php

namespace App\Http\Controllers;

use App\Models\Irs;
use App\Models\IrsDetail;
use App\Models\MataKuliah;
use App\Models\JadwalKuliah;
use Illuminate\Http\Request;
use Laravel\Ui\AuthRouteMethods;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

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

    public function buatirs() {
        // Mendapatkan data mahasiswa dari user yang login
        $mahasiswa = Auth::user()->mahasiswa;

        $currentDateTime = now(); 
    
        $currentPeriod = DB::table('irs_periods')
            ->where(function($query) use ($currentDateTime) {
                $query->where('periode_pengisian_start', '<=', $currentDateTime)
                      ->where('periode_pengisian_end', '>=', $currentDateTime)
                      ->orWhere(function($query) use ($currentDateTime) {
                          $query->where('periode_perubahan_start', '<=', $currentDateTime)
                                ->where('periode_perubahan_end', '>=', $currentDateTime);
                      })
                      ->orWhere(function($query) use ($currentDateTime) {
                          $query->where('periode_pembatalan_start', '<=', $currentDateTime)
                                ->where('periode_pembatalan_end', '>=', $currentDateTime);
                      })
                      ->orWhere(function($query) use ($currentDateTime) {
                          $query->where('periode_perkuliahan_start', '<=', $currentDateTime)
                                ->where('periode_perkuliahan_end', '>=', $currentDateTime);
                      });
            })
            ->first();
            
        $activePeriodType = null;
        $matkuls = null;
        if ($currentPeriod) {
            if ($currentPeriod->semester == 'gasal') {
                $matkuls = MataKuliah::where(function($query) {
                    $query->where('semester', '0') 
                          ->orWhereRaw('semester % 2 != 0');
                })->orderBy('semester', 'asc')->get();
            } elseif ($currentPeriod->semester == 'genap') {
                $matkuls = MataKuliah::whereRaw('semester % 2 = 0')->orderBy('semester', 'asc')->get();
            }

            if ($currentDateTime->between($currentPeriod->periode_pengisian_start, $currentPeriod->periode_pengisian_end)) {
                $activePeriodType = 'pengisian';
            } elseif ($currentDateTime->between($currentPeriod->periode_perubahan_start, $currentPeriod->periode_perubahan_end)) {
                $activePeriodType = 'perubahan';
            } elseif ($currentDateTime->between($currentPeriod->periode_pembatalan_start, $currentPeriod->periode_pembatalan_end)) {
                $activePeriodType = 'pembatalan';
            }
        }
    
        return view('mhs.akademik.buatirs', [
            'title' => 'Akademik', 
            'matkuls' => $matkuls, 
            'currentPeriod' => $currentPeriod, 
            'activePeriodType' => $activePeriodType,
            'mahasiswa' => $mahasiswa
        ]);
    }
    

    public function lihatirs() {
        return view('mhs.akademik.lihatirs', ['title' => 'Akademik']);
    }

}