<?php

use App\Exports\PenilaianExport;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndustriController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\PembimbingController;
use App\Http\Controllers\PengelompokkanController;
use App\Http\Controllers\PenilaianController;
use App\Http\Controllers\LogBookController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController;
use App\Models\Mahasiswa;
use App\Models\Penilaian;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route Login
Route::get('/', [AuthController::class, 'login'])->name('auth.login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/loginPost', [AuthController::class, 'loginPost'])->name('auth.loginPost');

// ADMIN
Route::get('/Admin/Industri/index', [IndustriController::class, 'index'])->name('Admin.Industri.index');

Route::get('/Admin/Mahasiswa/index', [MahasiswaController::class, 'index'])->name('Admin.Mahasiswa.index');
Route::get('/Admin/Mahasiswa/detail/{id}', [MahasiswaController::class, 'detail'])->name('Admin.Mahasiswa.detail');

Route::get('/Admin/Pembimbing/index', [PembimbingController::class, 'index'])->name('Admin.Pembimbing.index');
Route::get('/Admin/Pembimbing/create', [PembimbingController::class, 'create'])->name('Admin.Pembimbing.create');
Route::post('/Admin/Pembimbing/create', [PembimbingController::class, 'store'])->name('Admin.Pembimbing.store');
Route::get('/Admin/Pembimbing/{id}/edit', [PembimbingController::class, 'edit'])->name('Admin.Pembimbing.edit');
Route::put('/Admin/Pembimbing/{id}', [PembimbingController::class, 'update'])->name('Admin.Pembimbing.update');
Route::put('/Admin/Pembimbing/{id}/delete', [PembimbingController::class, 'destroy'])->name('Admin.Pembimbing.destroy');

Route::get('/Admin/Penilaian/index', [PenilaianController::class, 'index'])->name('Admin.Penilaian.index');
Route::get('/Admin/Penilaian/{id}/detail', [PenilaianController::class, 'detail'])->name('Admin.Penilaian.detail');
Route::get('/Admin/Penilaian/{id}/detailLaporan', [PenilaianController::class, 'detailLaporan'])->name('Admin.Penilaian.detailLaporan');
Route::get('/Admin/Penilaian/export', [PenilaianController::class, 'export'])->name('Admin.Penilaian.export');
Route::get('/Admin/Penilaian/export2/{id}', [PenilaianController::class, 'export2'])->name('Admin.Penilaian.export2');

Route::get('/Admin/Logbook/detail/{id}', [LogbookController::class, 'detail'])->name('Admin.Logbook.detail');

Route::get('/Admin/Pengelompokkan/index', [PengelompokkanController::class, 'index'])->name('Admin.Pengelompokkan.index');
Route::get('/Admin/Pengelompokkan/create', [PengelompokkanController::class, 'create'])->name('Admin.Pengelompokkan.create');
Route::post('/Admin/Pengelompokkan/create', [PengelompokkanController::class, 'store'])->name('Admin.Pengelompokkan.store');
Route::get('/Admin/Pengelompokkan/{id}/edit', [PengelompokkanController::class, 'edit'])->name('Admin.Pengelompokkan.edit');
Route::put('/Admin/Pengelompokkan/{id}', [PengelompokkanController::class, 'update'])->name('Admin.Pengelompokkan.update');
Route::put('/Admin/Pengelompokkan/{id}/delete', [PengelompokkanController::class, 'destroy'])->name('Admin.Pengelompokkan.destroy');
Route::get('/Admin/Pengelompokkan/{id}/detail', [PengelompokkanController::class, 'detail'])->name('Admin.Pengelompokkan.detail');

//Mahasiswa
Route::get('/Mahasiswa/LogBook/index', [LogBookController::class, 'index'])->name('Mahasiswa.LogBook.index');
Route::get('/Mahasiswa/LogBook/create', [LogBookController::class, 'create'])->name('Mahasiswa.LogBook.create');
Route::post('/Mahasiswa/LogBook/create', [LogBookController::class, 'store'])->name('Mahasiswa.LogBook.store');
Route::get('/Mahasiswa/LogBook/{id}/detail', [LogBookController::class, 'detail'])->name('Mahasiswa.LogBook.detail');
Route::get('/Mahasiswa/LogBook/{id}/edit', [LogBookController::class, 'edit'])->name('Mahasiswa.LogBook.edit');
Route::put('/Mahasiswa/LogBook/{id}', [LogBookController::class, 'update'])->name('Mahasiswa.LogBook.update');
Route::get('/Mahasiswa/LogBook/{id}/detailMahasiswa', [LogBookController::class, 'detail'])->name('Mahasiswa.LogBook.detailMahasiswa');

//Pembimbing
Route::get('/Pembimbing/Penilaian/firstPage', [PenilaianController::class, 'firstPage'])->name('Pembimbing.Penilaian.firstPage');
Route::get('/Pembimbing/Penilaian/create', [PenilaianController::class, 'create'])->name('Pembimbing.Penilaian.create');
Route::post('/Pembimbing/Penilaian/create', [PenilaianController::class, 'store'])->name('Pembimbing.Penilaian.store');

Route::post('/LogBookController/konfirmasi/{id}', [LogBookController::class, 'konfirmasi'])->name('LogBookController.konfirmasi');
Route::post('/LogBookController/tolak/{id}', [LogBookController::class, 'tolak'])->name('LogBookController.tolak');
Route::get('/Pembimbing/LogBook/daftar', [LogBookController::class, 'daftar'])->name('Pembimbing.LogBook.daftar');
Route::get('/Pembimbing/LogBook/detaillogbook/{id}', [LogBookController::class, 'detail'])->name('Pembimbing.LogBook.detaillogbook');



//dashboard
Route::get('/DashboardPembimbing', [DashboardController::class, 'dashboardpem'])->name('Pembimbing.DashboardPembimbing');
Route::get('/DashboadMahasiswa', [DashboardController::class, 'dashboardMahasiswa'])->name('Mahasiswa.DashboardMahasiswa');
Route::get('/DashboardSekprod', [DashboardController::class, 'dashboardSekprod'])->name('Sekprod.Dashboard.dashboard');
Route::get('/DashboardAdmin', [DashboardController::class, 'dashboardAdmin'])->name('Admin.DashboardAdmin');

//Sekprod

Route::get('/Sekprod/Mahasiswa/index', [MahasiswaController::class, 'index'])->name('Sekprod.Mahasiswa.index');
Route::get('/Sekprod/Mahasiswa/detail/{id}',[MahasiswaController::class, 'detail'])->name('Sekprod.Mahasiswa.detail');
Route::get('/Sekprod/Penilaian/index', [PenilaianController::class, 'index'])->name('Sekprod.LaporanPenilaian.index');
Route::get('/Admin/Penilaian/indexSekProd', [PenilaianController::class, 'indexSekProd'])->name('Admin.LaporanPenilaian.indexSekProd');
Route::get('/Sekprod/Penilaian/{id}/detail',[PenilaianController::class, 'detail'])->name('Sekprod.LaporanPenilaian.detail');
Route::get('/Sekprod/Penilaian/{id}/detailLaporan',[PenilaianController::class, 'detailLaporan'])->name('Sekprod.LaporanPenilaian.detailLaporan');

Route::get('/getMahasiswaData/{dwa_id}', [PenilaianController::class, 'getMahasiswaData'])->name('Penilaian.getMahasiswaData');
Route::post('/LogBookController/kirimLogBook/{logId}', [LogBookController::class, 'kirimLogBook'])->name('LogBookController.kirimLogBook');
Route::get('/LogBookController/kirimLogBook/{id}', [LogBookController::class, 'kirimLogBook'])->name('logbook.kirimLogBook');

  

