<?php

namespace App\Http\Controllers;

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
        $mhs = DB::table('mahasiswas')
            ->where('pembimbing_akademik_id', $id)
            ->get();
        return $mhs;
    }


}
