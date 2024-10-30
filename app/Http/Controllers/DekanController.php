<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DekanController extends Controller
{
    public function index() {
        echo "ini dashboard dekan";
        echo "<h1>" . Auth::user()->name . "</h1>";
        echo "<a href='/logout'>Logout</a>";
    }
}
