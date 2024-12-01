<?php

namespace App\Http\Controllers;

use App\Models\Khs;
use App\Models\IrsDetail;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PembimbingAkademikController extends Controller
{
    public function index() {
        $pa = Auth::user()->pembimbingAkademik;
        $infoPA = $pa->dosen;
        $totalMahasiswaPerwalian = $pa->getTotalMahasiswaPerwalian();
        $totalIrsDisetujui = $pa->getTotalIrsDisetujui();
        $totalIrsBelumDisetujui = $pa->getTotalIrsBelumDisetujui();
        $totalMhsBelumIrs = $pa->getTotalMhsBelumIrs();


        return view('pa.dashboard', 
        [
            'title' => 'Dashboard - PA', 
            'pa' => $infoPA, 
            'totalMahasiswaPerwalian' => $totalMahasiswaPerwalian,
            'totalIrsDisetujui' => $totalIrsDisetujui,
            'totalIrsBelumDisetujui' => $totalIrsBelumDisetujui,
            'totalMhsBelumIrs' => $totalMhsBelumIrs,
        ]);
    }
    public function perwalian() {
        $pa = Auth::user()->pembimbingAkademik;

        $irsController = new IrsController();
        // $irsPeriodController = new IrsPeriodsController();

        // $irs = $irsController->getIRSforPA($pa);
        // $currentPeriod = $irsPeriodController->getCurrentPeriod();

        // // data irs yg sesuai dgn periode skrg
        // $irs = $irs->where('jenis_semester', $currentPeriod->semester)
        //             ->where('tahun_ajaran', $currentPeriod->tahun_ajaran);
        $mhs = $irsController->getAllMhsPerwalianWithIrsCurrentPeriod($pa);
        return view('pa.perwalian', ['title' => 'Perwalian - PA', 'mhs' => $mhs]);
    }


    public function rekapmhs() {
        $pa = Auth::user()->pembimbingAkademik;
        $mhs = $this->getMahasiswaPerwalian($pa->id);

        return view('pa.rekapmhs', ['title' => 'Rekap Mhs - PA', 'mhs' => $mhs]);
    }

    public function getMahasiswaPerwalian($id)
    {
        $mhs = Mahasiswa::with('prodi')
        ->where('pembimbing_akademik_id', $id)
        ->paginate(10);
        return $mhs;
    }

    public function showIrsByNim($nim)
    {
        $irsByNim = DB::table('irs')
                    ->where('nim', '=', $nim)
                    ->get();
        $irsByNim->each(function ($item) {
            $item->irsDetails = IrsDetail::where('irs_id', $item->id)
                                    ->get()->each(function($detail) {
                                        $detail->dosenPengampuList = $detail->mataKuliah->dosenPengampu;
                                    });
        });
        $mhsByNim = Mahasiswa::with([
            'prodi', 
        ])
        ->where('nim', '=', $nim)
        ->first(); 
        return view('pa.rekapmhs.irs', [
            'title' => 'IRS Mhs',
            'irs' => $irsByNim,
            'mhs' => $mhsByNim,
        ]);
    }

    public function showKhsByNim($nim)
    {
        $mhs = Mahasiswa::with([
            'irs',                      
            'irs.irsDetails',                      
            'irs.irsDetails.mataKuliah',                      
            'irs.khs',     
            'irs.khs.khsDetails.irsDetail',
            'irs.khs.khsDetails.irsDetail.mataKuliah',
            'prodi', 
        ])
        ->where('nim', '=', $nim)
        ->first(); 
        return view('pa.rekapmhs.khs', [
            'title' => 'KHS Mhs',
            'mhs' => $mhs,
        ]);
    }
}
