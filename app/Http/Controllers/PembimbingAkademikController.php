<?php

namespace App\Http\Controllers;

use App\Models\IrsDetail;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PembimbingAkademikController extends Controller
{
    public function index() {
        return view('pa.dashboard', ['title' => 'Dashboard - PA']);
    }
    public function perwalian() {
        $pa = Auth::user()->pembimbingAkademik;

        $irsController = new IrsController();
        $irsPeriodController = new IrsPeriodsController();

        $irs = $irsController->getIRSforPA($pa);
        $currentPeriod = $irsPeriodController->getCurrentPeriod();

        // data irs yg sesuai dgn periode skrg
        $irs = $irs->where('jenis_semester', $currentPeriod->semester)
                    ->where('tahun_ajaran', $currentPeriod->tahun_ajaran);
        
        return view('pa.perwalian', ['title' => 'Perwalian - PA', 'irs' => $irs]);
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
        ->get();
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
        $mhsByNim = DB::table('mahasiswas')
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
        $khsByNim = DB::table('khs')
                    ->join('irs', 'khs.irs_id', '=', 'irs.id')
                    ->where('irs.nim', '=', $nim)
                    ->select('khs.*', 'irs.*')
                    ->get();
        $mhsByNim = DB::table('mahasiswas')
                    ->where('nim', '=', $nim)
                    ->get();

        return view('pa.rekapmhs.khs', [
            'title' => 'KHS Mhs',
            'khs' => $khsByNim,
            'mhs' => $mhsByNim,
        ]);
    }

}
