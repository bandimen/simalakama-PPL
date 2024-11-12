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
        $irs = $irsController->getIRSforPA($pa);

        return view('pa.perwalian', ['title' => 'Perwalian - PA', 'irs' => $irs]);
    }
    public function rekapmhs() {
        return view('pa.rekapmhs', ['title' => 'Rekap Mhs - PA']);
    }
}
