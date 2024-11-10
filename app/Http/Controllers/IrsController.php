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
use App\Http\Controllers\IrsPeriodsController;

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
                    'status' => $item['status'] ?? 'Baru'
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

        $irsPeriodsController = new IrsPeriodsController();
        $currentPeriod = $irsPeriodsController->getCurrentPeriod();
        $currentDateTime = now();

        $activePeriodType = null;
        $matkuls = null;
        if ($currentPeriod) {
            if ($currentPeriod->semester == 'Gasal') {
                $matkuls = MataKuliah::where(function($query) {
                    $query->where('semester', '0') 
                          ->orWhereRaw('semester % 2 != 0');
                })->orderBy('semester', 'asc')->get();
            } elseif ($currentPeriod->semester == 'Genap') {
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
        // Ambil data mahasiswa dari user yang login
        $user = Auth::user();
        $mahasiswa = $user->mahasiswa;
    
        // Ambil data Pembimbing Akademik (PA) dari mahasiswa
        $pa = $mahasiswa->pembimbingAkademik?->dosen;
    
        // Ambil data IRS beserta detail dan relasi berdasarkan nim mahasiswa
        $irs = Irs::where('nim', $mahasiswa->nim)
                    ->with(['irsDetails.mataKuliah', 'irsDetails.jadwalKuliah.ruang'])
                    ->first();
    
        // Dapatkan periode saat ini dari IrsPeriodsController
        $irsPeriodsController = new IrsPeriodsController();
        $currentPeriod = $irsPeriodsController->getCurrentPeriod();
    
        // Kirim variabel `$irs`, `$irsDetails`, `$mahasiswa`, `$pa`, dan `$currentPeriod` ke view
        return view('mhs.akademik.lihatirs', [
            'title' => 'Akademik',
            'irs' => $irs,
            'irsDetails' => $irs ? $irs->irsDetails : [],
            'mahasiswa' => $mahasiswa,
            'pa' => $pa, // Tambahkan data PA ke view
            'currentPeriod' => $currentPeriod, // Tambahkan data periode saat ini ke view
        ]);
    }
    
    public function getIRSforPA($pa)
    {
        // select semua irs sesuai id
        $irs = DB::table('irs')
        ->join('mahasiswas', 'irs.nim', '=', 'mahasiswas.nim')
        ->select('irs.*', 'mahasiswas.nama', 'mahasiswas.angkatan', 'mahasiswas.pembimbing_akademik_id')
        ->where('mahasiswas.pembimbing_akademik_id', '=', $pa->id)
        ->get();

        //hubungkan tabel irs dengan tabel irs_details satu satu 
        $irs->each(function ($item) {
            $item->irsDetails = IrsDetail::where('irs_id', $item->id)->get();
        });
        return $irs;
    }

    public function setujuiIrs($id)
    {
        DB::table('irs')
            ->where('id', $id)
            ->update(['status' => 'Disetujui']);

        return redirect()->back();
    }

    public function batalkanIrs($id)
    {
        DB::table('irs')
            ->where('id', $id)
            ->update(['status' => 'Belum disetujui']);

        return redirect()->back();
    }

    public function getIrsDetails($id)
    {
        $irsDetails = DB::table('irs_details')
                    ->where('irs_id', $id)
                    ->get();

        return $irsDetails;
    }


    
}