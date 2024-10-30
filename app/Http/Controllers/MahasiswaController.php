<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MahasiswaController extends Controller
{
    public function index() {
        return view('mhs.dashboard', ['title' => 'Dashboard Mahasiswa']);
    }

    public function irs() {
        return view('mhs.irs', ['title' => 'IRS Mahasiswa']);
    }

    public function khs() {
        return view('mhs.khs', ['title' => 'KHS Mahasiswa']);
    }
}
