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
use App\Models\Mahasiswa;

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
        $irsPeriodsController = new IrsPeriodsController();
        $currentPeriod = $irsPeriodsController->getCurrentPeriod();
        $currentDateTime = now();

        $mahasiswa = Auth::user()->mahasiswa;

        if ($mahasiswa) {
            $mahasiswa->load([
                'irs' => function ($query) use ($currentPeriod) {
                    $query->where('jenis_semester', $currentPeriod->semester)
                          ->where('tahun_ajaran', $currentPeriod->tahun_ajaran);
                },
                'irs.irsDetails',
                'irs.irsDetails.mataKuliah',
                'prodi',
            ]);
        }

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

    public function lihatirs(Request $request) {
        // Ambil data mahasiswa dari user yang login
        $user = Auth::user();
        $mahasiswa = $user->mahasiswa;
    
        // Ambil data Pembimbing Akademik (PA) dari mahasiswa
        $pa = $mahasiswa->pembimbingAkademik?->dosen;
    
        // Dapatkan periode saat ini dari IrsPeriodsController
        $irsPeriodsController = new IrsPeriodsController();
        $currentPeriod = $irsPeriodsController->getCurrentPeriod();
    
        // Hitung semester aktif saat ini berdasarkan angkatan mahasiswa dan periode aktif
        $currentSemester = $this->getSemester($mahasiswa->angkatan, $currentPeriod);
    
        // Ambil semester dari parameter URL, jika tidak ada maka default ke currentSemester
        $selectedSemester = $request->query('semester', $currentSemester);
    
        // Ambil data IRS yang cocok dengan kode_mk dari mataKuliah dan filter by semester yang dipilih
        $irs = Irs::where('nim', $mahasiswa->nim)
                    ->with(['irsDetails' => function($query) use ($selectedSemester) {
                        $query->whereHas('mataKuliah', function ($query) use ($selectedSemester) {
                            $query->where('semester', $selectedSemester); // Filter by semester di mataKuliah
                        })->with(['mataKuliah', 'jadwalKuliah.ruang']);
                    }])
                    ->first();
    
        // Kirim variabel `$irs`, `$irsDetails`, `$mahasiswa`, `$pa`, dan `$currentPeriod` ke view
        return view('mhs.akademik.lihatirs', [
            'title' => 'Akademik',
            'irs' => $irs,
            'irsDetails' => $irs ? $irs->irsDetails : [],
            'mahasiswa' => $mahasiswa,
            'pa' => $pa,
            'currentPeriod' => $currentPeriod,
            'currentSemester' => $currentSemester, // Semester aktif
            'selectedSemester' => $selectedSemester, // Semester yang dipilih
        ]);
    }
    
    public function getIRSforPA($pa)
    {
        // select semua irs sesuai id
        $irs = DB::table('irs')
        ->join('mahasiswas', 'irs.nim', '=', 'mahasiswas.nim')
        ->join('prodis', 'mahasiswas.prodi_id', '=', 'prodis.id') 
        ->select('irs.*', 'mahasiswas.nama', 'mahasiswas.angkatan', 'mahasiswas.pembimbing_akademik_id', 'mahasiswas.prodi_id', 'prodis.nama as nama_prodi')
        ->where('mahasiswas.pembimbing_akademik_id', '=', $pa->id)
        ->get();


        //hubungkan tabel irs dengan tabel irs_details satu satu 
        $irs->each(function ($item) {
            $item->irsDetails = IrsDetail::where('irs_id', $item->id)
                                    ->get()->each(function($detail) {
                                        $detail->dosenPengampuList = $detail->mataKuliah->dosenPengampu;
                                    });
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

    public function getSemester($angkatan, $currentPeriod)
    {
        // Pisahkan tahun akademik menjadi tahun awal dan akhir
        $currentTahunAjaran = explode('/', $currentPeriod->tahun_ajaran);
        $currentTahunAwal = (int)$currentTahunAjaran[0];
    
        // Tentukan tahun angkatan mahasiswa
        $tahunAngkatan = (int)$angkatan;
    
        // Hitung selisih tahun antara tahun angkatan mahasiswa dan tahun ajaran saat ini
        $selisihTahun = $currentTahunAwal - $tahunAngkatan;
    
        // Setiap tahun memiliki 2 semester (ganjil dan genap), lakukan perhitungan berdasarkan semester aktif
        if ($currentPeriod->semester == 'Gasal') {
            // Jika semester Gasal (ganjil), tambahkan 1 untuk semester ganjil
            $semester = ($selisihTahun * 2) + 1;
        } elseif ($currentPeriod->semester == 'Genap') {
            // Jika semester Genap, tambahkan 2 untuk semester genap
            $semester = ($selisihTahun * 2) + 2;
        }
        
        return $semester;
    }    

    public function getAllMhsPerwalianWithIrsCurrentPeriod($pa)
    {
        $irsPeriodsController = new IrsPeriodsController();
        $currentPeriod = $irsPeriodsController->getCurrentPeriod();
        $mhs = Mahasiswa::with(['irs' => function ($query) use ($currentPeriod) {
            $query->where('jenis_semester', $currentPeriod->semester)
                  ->where('tahun_ajaran', $currentPeriod->tahun_ajaran);
        }, 'irs.irsDetails', 'irs.irsDetails.mataKuliah', 'prodi'])
            ->where('pembimbing_akademik_id', '=', $pa->id)
            ->get();
        

        return $mhs;
    }

}

