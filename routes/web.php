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
    
    // Route::get('/', function () {
    //     return view('home');
    // });

    Route::get('/', [HomeController::class, 'index'])->name('home');

    // Route::get('form', function () {
    //     return view('pages.form');
    // });
    Route::get('data-pegawai', function () {
        return view('pages.pegawai');
    });
    
    // Route::get('table', function () {
    //     return view('pages.table');
    // });    

    Route::get('table-pengajuan',[HomeController::class, 'pengajuanCuti']);
    Route::get('table-ditolak',[HomeController::class, 'cutiDitolak']);
    Route::get('table-diterima',[HomeController::class, 'cutiDiterima']);
    Route::get('pegawai',[HomeController::class, 'pegawai']);
    Route::get('form',[HomeController::class, 'form']);
    
    Route::post('/cuti/{id}/confirm', [YourController::class, 'confirmCuti'])->name('cuti.confirm');
    Route::post('kirim-pengajuan',[HomeController::class, 'kirimPengajuan']);
    Route::post('daftar-pegawai',[HomeController::class, 'daftarPegawai']);

    Route::get('hapus-pengajuan/{id}',[HomeController::class, 'hapusPengajuan']);
});