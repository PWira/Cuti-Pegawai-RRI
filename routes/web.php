<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\adminController;
use App\Http\Controllers\downloadDoc;

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

Route::group(['middleware' => 'admin'], function () {
    
    Route::get('/admin/create-user', function () {
        return view('auth.createUser');
    });

    Route::get('/admin/user',[adminController::class, 'daftarUser']);

    Route::post('/admin/users', [adminController::class, 'createUser'])->name('admin.users.store')->middleware('admin');

    Route::get('hapus-user/{id}',[adminController::class, 'hapusUser']);

});


Route::middleware(['auth'])->group(function () {
    
    // Route::get('/', function () {
    //     return view('home');
    // });

    Route::get('/', [HomeController::class, 'index'])->name('home');

    Route::get('data-pegawai', function () {
        return view('pages.pegawai');
    });
    Route::post('daftar-pegawai',[HomeController::class, 'daftarPegawai']);

    Route::get('pengajuan/semua', [downloadDoc::class, 'pengajuanSemua']);
    Route::get('pengajuan/diterima', [downloadDoc::class, 'pengajuanDiterima']);
    Route::get('pengajuan/ditolak', [downloadDoc::class, 'pengajuanDitolak']);
    Route::get('/doc-pegawai', [downloadDoc::class, 'dataPegawai']);

    Route::get('pengajuan-anda',[HomeController::class, 'pengajuanSaya']);
    Route::get('table-pengajuan',[HomeController::class, 'pengajuanCuti']);
    Route::get('table-ditolak',[HomeController::class, 'cutiDitolak']);
    Route::get('table-diterima',[HomeController::class, 'cutiDiterima']);
    Route::get('pegawai',[HomeController::class, 'pegawai']);
    Route::get('form',[HomeController::class, 'form']);
    Route::get('/edit-pegawai/{pid}', [HomeController::class, 'editPegawai'])->name('edit-pegawai');
    Route::put('/update-pegawai/{pid}', [HomeController::class, 'updatePegawai'])->name('update-pegawai');

    Route::get('rekapitulasi',[HomeController::class, 'rekapitulasi']);
    // Route::get('test-form-baru',[HomeController::class, 'testFormBaru']);
    Route::get('/generate-pdf', [downloadDoc::class, 'generatePDF'])->name('generate.pdf');
    
    Route::post('/respon-cuti', [HomeController::class, 'responCuti'])->name('respon.cuti');
    Route::post('/respon-sakit', [HomeController::class, 'responSakit'])->name('respon.sakit');
    // Route::post('/sakit-pengajuan',[HomeController::class, 'sakitPengajuan'])->name('kirim.sakit');
    Route::post('kirim-pengajuan',[HomeController::class, 'kirimPengajuan']);

    Route::get('hapus-pengajuan-personal/{id}',[HomeController::class, 'hapusPengajuanPersonal']);
    Route::get('hapus-pengajuan/{id}',[HomeController::class, 'hapusPengajuan']);
    Route::get('hapus-pegawai/{id}',[HomeController::class, 'hapusPegawai']);

});