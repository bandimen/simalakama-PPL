<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DekanController extends Controller
{
    public function index() {
        // data mahasiswa yg diambil di proses sessionController pas login dibawa ke view
        $user = Auth::user();
        $dekan = $user->dekan;
        return view('dekan.dashboard', ['title' => 'Dashboard Dekan', 'dekan' => $dekan]);
    }
}
