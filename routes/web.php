<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DekanController;
use Illuminate\Contracts\Session\Session;
use App\Http\Controllers\KaprodiController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\BagianAkademikController;
use App\Http\Controllers\PembimbingAkademikController;

// kalo belum login
Route::middleware(['guest'])->group(function () {
  Route::get('/', [SessionController::class, 'index'])->name('login');  // ->name login ni biar dikembalikan lagi ke halaman login jika user blm login
  Route::post('/', [SessionController::class, 'login']);
});

// ini routing kalo misal udah login tp balik lagi ke simalakama-ppl.test alias mau login lagi, lsg redirect ke halaman login mhs
Route::get('/home', function() {
  return redirect('/mhs');
});


// ini routing yang bisa dijalankan apabila dlm kondisi login
Route::middleware(['auth'])->group(function () {
  Route::get('/mhs', [MahasiswaController::class, 'index']);
  Route::get('/mhs/irs', [MahasiswaController::class, 'irs']);
  Route::get('/mhs/khs', [MahasiswaController::class, 'khs']);

  Route::get('/pa', [PembimbingAkademikController::class, 'index']);

  Route::get('/ba', [BagianAkademikController::class, 'index']);

  Route::get('/dekan', [DekanController::class, 'index']);

  Route::get('/kaprodi', [KaprodiController::class, 'index']);

  Route::get('/logout', [SessionController::class, 'logout']);
  Route::get('/select-role', [SessionController::class, 'showSelectRolePage'])->name('selectRole');
  Route::post('/select-role', [SessionController::class, 'selectRole']);
});


