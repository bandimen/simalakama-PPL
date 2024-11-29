<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IrsController;
use App\Http\Controllers\IrsDetailController;
use App\Http\Controllers\KhsController;
use App\Http\Controllers\DekanController;
use Illuminate\Contracts\Session\Session;
use App\Http\Controllers\KaprodiController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\MataKuliahController;
use App\Http\Controllers\BagianAkademikController;
use App\Http\Controllers\JadwalKuliahController;
use App\Http\Controllers\PembimbingAkademikController;
use App\Http\Controllers\RuangController;
use App\Http\Controllers\TenagaPendidikController;
use App\Models\TenagaPendidik;

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
  // MAHASISWA
  Route::get('/mhs', [MahasiswaController::class, 'index'])->name('mhs');
  Route::get('/mhs/akademik', [IrsController::class, 'buatirs']);
  Route::get('/mhs/akademik/lihatkhs', [KhsController::class, 'lihatkhs']);
  //buat irs
  Route::get('/mhs/akademik/buatirs', [IrsController::class, 'buatirs']);
  Route::get('/mhs/akademik/lihatirs', [IrsController::class, 'lihatirs']);
  Route::get('/jadwal/{kodemk}', [MahasiswaController::class, 'getJadwal']);
  Route::post('/irs/details', [IrsController::class, 'storeDetail']);
  Route::get('/irs/selected-schedules', [IrsController::class, 'getSelectedSchedules']);
  Route::post('/irs/store', [IrsController::class, 'store']);
  Route::post('/irs-detail/store', [IrsDetailController::class, 'store']);
  // Route::post('/save-selected-course', [IrsDetailController::class, 'saveSelectedCourse']);
  // Route::post('/irs-detail/store', [IrsDetailController::class, 'save'])->middleware('auth');
  // Route::get('/irs-detail/load', [IrsDetailController::class, 'load'])->middleware('auth');
  // hapus irs detail
  Route::get('mhs/buatirs/delete/{id}', [IrsDetailController::class, 'delete'])->name('deleteIrsDetail');

  // lihat khs 
  Route::get('/mhs/akademik/lihatkhs', [KhsController::class, 'lihatkhs']);
  
  // PEMBIMBING AKADEMIK
  Route::get('/pa', [PembimbingAkademikController::class, 'index']);
  Route::get('/pa/perwalian', [PembimbingAkademikController::class, 'perwalian']);
  Route::get('/pa/rekapmhs', [PembimbingAkademikController::class, 'rekapmhs']);
  // setujui n batalkan irs
  Route::get('/pa/perwalian/setujui-irs/{id}', [IrsController::class, 'setujuiIrs'])->name('setujuiIrs'); //name ini  digunakan sbg alias
  Route::get('/pa/perwalian/batalkan-irs/{id}', [IrsController::class, 'batalkanIrs'])->name('batalkanIrs');
  // show irs dan khs mhs
  Route::get('pa/rekapmhs/irs/{nim}', [PembimbingAkademikController::class, 'showIrsByNim'])->name('showIrsByNim');
  Route::get('pa/rekapmhs/khs/{nim}', [PembimbingAkademikController::class, 'showKhsByNim'])->name('showKhsByNim');

  // DEKAN
  Route::get('/dekan', [DekanController::class, 'index']);
  Route::get('/dekan/matkul', [DekanController::class, 'matkul']);
  Route::get('/dekan/ruangacc', [DekanController::class, 'ruangacc']);
  Route::resource('mataKuliah', MataKuliahController::class);
  Route::get('/dekan/ruangacc', [RuangController::class, 'verifikasi'])->name('ruangs.verifikasi');
  Route::patch('/ruangs/approve/{id}', [RuangController::class, 'approve'])->name('ruangs.approve');
  Route::get('/dekan/matkul', [DekanController::class, 'jadwalKuliah'])->name('dekan.matkul');
  Route::patch('/dekan/matkul/{id}/approve', [DekanController::class, 'approveJadwalKuliah'])->name('dekan.matkul.approve');
  


  //TENAGA PENDIDIK alias BAGIAN AKADEMIK
  Route::get('/akademik',[TenagaPendidikController::class,'index']);
  Route::get('/akademik/tambahruang',[TenagaPendidikController::class,'tambahruang']);
  Route::post('/ruang', [RuangController::class, 'store'])->name('ruang.store');
  Route::delete('ruang/{ruang}', [RuangController::class, 'destroy'])->name('ruang.destroy');
  Route::get('ruang/create', [RuangController::class, 'create'])->name('ruang.create');
  Route::get('/akademik/tambahruang', [RuangController::class, 'index'])->name('ruang.index');



  // KAPRODI
  Route::get('/kaprodi', [KaprodiController::class, 'index']);
  Route::get('/kaprodi/jadwalKuliah', [JadwalKuliahController::class, 'index']);
  Route::get('/kaprodi/tambah-jadwal', [JadwalKuliahController::class, 'create'])->name('tambahJadwal');
  Route::post('/kaprodi/tambah-jadwal', [JadwalKuliahController::class, 'store'])->name('simpanJadwal');

  Route::get('/logout', [SessionController::class, 'logout']);
  
  // Select Role
  Route::get('/select-role', [SessionController::class, 'showSelectRolePage'])->name('selectRole');
  Route::post('/select-role', [SessionController::class, 'selectRole']);
});


