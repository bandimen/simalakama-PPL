<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PembimbingAkademikController extends Controller
{
    public function index() {
        return view('pa.dashboard', ['title' => 'Dashboard Pembimbing Akademik']);
    }
}
