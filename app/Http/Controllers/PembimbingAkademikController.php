<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PembimbingAkademikController extends Controller
{
    public function index() {
        return view('pa.dashboard', ['title' => 'Dashboard - PA']);
    }
    public function perwalian() {
        return view('pa.perwalian', ['title' => 'Perwalian - PA']);
    }
    public function rekapmhs() {
        return view('pa.rekapmhs', ['title' => 'Rekap Mhs - PA']);
    }
}
