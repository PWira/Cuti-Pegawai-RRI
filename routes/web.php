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
    // Route::get('/admin/create-user', function () {
    //     return view('auth.user');
    // });
    // Route::get('/admin/create-user', function () {
    //     return view('auth.createUser');
    // });
    // Route::get('table', function () {
    //     return view('pages.table');
    // });    

    Route::get('table-pengajuan',[HomeController::class, 'pengajuanCuti']);
    Route::get('table-ditolak',[HomeController::class, 'cutiDitolak']);
    Route::get('table-diterima',[HomeController::class, 'cutiDiterima']);
    Route::get('pegawai',[HomeController::class, 'pegawai']);
    Route::get('form',[HomeController::class, 'form']);
    Route::get('/admin/create-user',[HomeController::class, 'daftarUser']);
    
    Route::post('/respon-cuti', [HomeController::class, 'responCuti'])->name('respon.cuti');
    Route::post('kirim-pengajuan',[HomeController::class, 'kirimPengajuan']);
    Route::post('daftar-pegawai',[HomeController::class, 'daftarPegawai']);

    Route::post('/admin/users', [HomeController::class, 'store'])->name('admin.users.store')->middleware('admin');

    Route::get('hapus-pengajuan/{id}',[HomeController::class, 'hapusPengajuan']);
    Route::get('hapus-pegawai/{id}',[HomeController::class, 'hapusPegawai']);
});