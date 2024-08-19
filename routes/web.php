<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\HomeController;

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

Route::middleware(['auth'])->group(function () {
    
    Route::get('/', function () {
        return view('home');
    });

    Route::get('home', [HomeController::class, 'index'])->name('home');

    Route::get('form', function () {
        return view('pages.form');
    });
    Route::get('pegawai', function () {
        return view('pages.pegawai');
    });
    
    // Route::get('table', function () {
    //     return view('pages.table');
    // });    
    
    Route::post('kirim-pengajuan',[HomeController::class, 'kirimPengajuan']);
    Route::post('daftar-pegawai',[HomeController::class, 'daftarPegawai']);

    Route::get('table-pengajuan',[HomeController::class, 'pengajuanCuti']);
    Route::get('table-ditolak',[HomeController::class, 'cutiDitolak']);
    Route::get('table-diterima',[HomeController::class, 'cutiDiterima']);
    Route::get('pegawai-aktif',[HomeController::class, 'pegawaiAktif']);
    Route::get('pegawai-cuti',[HomeController::class, 'pegawaiCuti']);
    Route::get('hapus-pengajuan/{id}',[HomeController::class, 'hapusPengajuan']);
});