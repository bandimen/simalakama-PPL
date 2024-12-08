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
use App\Models\JadwalKuliah;
use App\Models\MataKuliah;
use App\Models\PembimbingAkademik;
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
  //buat irs
  Route::get('/mhs/akademik/buatirs', [IrsController::class, 'buatirs']);
  Route::get('/mhs/akademik/lihatirs', [IrsController::class, 'lihatirs']);
  Route::get('/mhs/akademik/lihatkhs', [KhsController::class, 'lihatkhs']);
  Route::get('/jadwal/{kodemk}', [MahasiswaController::class, 'getJadwal']);
  Route::post('/irs/details', [IrsController::class, 'storeDetail']);
  Route::get('/irs/selected-schedules', [IrsController::class, 'getSelectedSchedules']);
  Route::post('/irs/store', [IrsController::class, 'store']);
  Route::post('/irs-detail/store', [IrsDetailController::class, 'store']);
  Route::delete('/irs-detail/delete-all', [IrsDetailController::class, 'deleteAll']);
  Route::get('/api/getMaxBebanSks', [MahasiswaController::class, 'getMaxBebanSks']);

  Route::get('/mataKuliah/sks/{kodemk}', [MataKuliahController::class, 'getSksByKode']);
  // Route::post('/save-selected-course', [IrsDetailController::class, 'saveSelectedCourse']);
  // Route::post('/irs-detail/store', [IrsDetailController::class, 'save'])->middleware('auth');
  // Route::get('/irs-detail/load', [IrsDetailController::class, 'load'])->middleware('auth');
  // hapus irs detail
  Route::get('mhs/buatirs/delete/{id}', [IrsDetailController::class, 'delete'])->name('deleteIrsDetail');
  
  // PEMBIMBING AKADEMIK
  Route::get('/pa', [PembimbingAkademikController::class, 'index']);
  Route::get('/pa/perwalian', [PembimbingAkademikController::class, 'perwalian']);
  Route::get('/pa/rekapmhs', [PembimbingAkademikController::class, 'rekapmhs']);
  // setujui n batalkan irs
  Route::post('/pa/perwalian/setujui-irs/{id}', [IrsController::class, 'setujuiIrs'])->name('setujuiIrs'); //name ini  digunakan sbg alias
  Route::post('/pa/perwalian/batalkan-irs/{id}', [IrsController::class, 'batalkanIrs'])->name('batalkanIrs');
  // show irs dan khs mhs
  Route::get('pa/rekapmhs/irs/{nim}', [PembimbingAkademikController::class, 'showIrsByNim'])->name('showIrsByNim');
  Route::get('pa/rekapmhs/khs/{nim}', [PembimbingAkademikController::class, 'showKhsByNim'])->name('showKhsByNim');
  // ajax tabel perwalian
  Route::get('/pa/perwalian/search', [PembimbingAkademikController::class, 'ajaxTabelPerwalian'])->name('ajaxPerwalian');
  // ajax tabel rekapmhs
  Route::get('/pa/rekapmhs/search', [PembimbingAkademikController::class, 'ajaxTabelRekapMhs'])->name('ajaxRekapMhs');

  // DEKAN
  Route::get('/dekan', [DekanController::class, 'index']);
  Route::get('/dekan/matkul', [DekanController::class,'matkul'])->name('dekan.matkul');
  Route::get('/dekan/ruangacc', [DekanController::class, 'ruangacc']);
  Route::resource('mataKuliah', MataKuliahController::class);
  Route::get('/dekan/ruangacc', [RuangController::class, 'verifikasi'])->name('ruangs.verifikasi');
  Route::patch('/ruangs/approve/{id}', [RuangController::class, 'approve'])->name('ruangs.approve');
  Route::patch('/dekan/matkul/{id}/approve', [DekanController::class, 'approveJadwalKuliah'])->name('dekan.matkul.approve');
  Route::get('/ruangs/verifikasi', [RuangController::class, 'verifikasi'])->name('ruangs.verifikasi');
  Route::patch('/ruangs/approve-all/{prodiId}', [RuangController::class, 'approveAll'])->name('ruangs.approveAll');
  Route::patch('/ruangs/approve/{id}', [RuangController::class, 'approve'])->name('ruangs.approve');
  Route::patch('/dekan/prodi/{prodi}/approve', [DekanController::class, 'approveJadwalProdi'])->name('dekan.prodi.approve');
  Route::get('/dekan/verifikasi', [DekanController::class, 'verifikasi'])->name('dekan.verifikasi');
  Route::patch('/dekan/approve/{prodiId}', [DekanController::class, 'approveAll'])->name('dekan.approveAll');




  //TENAGA PENDIDIK alias BAGIAN AKADEMIK
  Route::get('/akademik',[TenagaPendidikController::class,'index']);
  Route::get('/akademik/tambahruang',[TenagaPendidikController::class,'tambahruang']);
  Route::post('/ruang', [RuangController::class, 'store'])->name('ruang.store');
  Route::delete('ruang/{ruang}', [RuangController::class, 'destroy'])->name('ruang.destroy');
  Route::get('ruang/create', [RuangController::class, 'create'])->name('ruang.create');
  Route::get('/akademik/tambahruang', [RuangController::class, 'index'])->name('ruang.index');
  Route::get('/ruang/{id}/edit', [RuangController::class, 'edit'])->name('ruang.edit');
  Route::put('/ruang/{id}', [RuangController::class, 'update'])->name('ruang.update');




  // KAPRODI
  Route::get('/kaprodi', [KaprodiController::class, 'index']);
  Route::get('/kaprodi/jadwalKuliah', [JadwalKuliahController::class, 'index'])->name('kaprodi.jadwalKuliah');
  Route::get('/jadwal-kuliah/search', [KaprodiController::class, 'search'])->name('kaprodi.search');
  Route::get('/jadwal-kuliah/tambah', [JadwalKuliahController::class, 'create'])->name('kaprodi.tambahJadwal');
  Route::post('/kaprodi/jadwalKuliah', [JadwalKuliahController::class, 'store'])->name('kaprodi.storeJadwal');
  Route::get('/kaprodi/edit-jadwal/{id}', [JadwalKuliahController::class, 'edit'])->name('kaprodi.editJadwal');
  Route::put('/kaprodi/update-jadwal/{id}', [JadwalKuliahController::class, 'update'])->name('kaprodi.updateJadwal');
  Route::delete('/kaprodi/delete-jadwal/{id}', [JadwalKuliahController::class, 'destroy'])->name('kaprodi.deleteJadwal');

  Route::get('/kaprodi/mataKuliah', [MataKuliahController::class, 'index'])->name('kaprodi.mataKuliah');
  Route::get('/kaprodi/mataKuliah/tambah', [MataKuliahController::class, 'create'])->name('kaprodi.tambahMataKuliah');
  Route::post('/kaprodi/mataKuliah', [MataKuliahController::class, 'store'])->name('kaprodi.storeMataKuliah');
  Route::get('/kaprodi/mataKuliah/{kodemk}/edit', [MataKuliahController::class, 'edit'])->name('kaprodi.editMataKuliah');
  Route::put('/kaprodi/mataKuliah/{kodemk}', [MataKuliahController::class, 'update'])->name('kaprodi.updateMataKuliah');
  Route::delete('/kaprodi/mataKuliah/{kodemk}', [MataKuliahController::class, 'destroy'])->name('kaprodi.deleteMataKuliah');


  Route::get('/logout', [SessionController::class, 'logout']);

  // Select Role
  Route::get('/select-role', [SessionController::class, 'showSelectRolePage'])->name('selectRole');
  Route::post('/select-role', [SessionController::class, 'selectRole']);
});


