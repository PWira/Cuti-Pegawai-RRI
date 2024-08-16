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
    
    Route::get('table', function () {
        return view('pages.table');
    });    
    
    Route::post('kirim-pengajuan',[HomeController::class, 'kirimPengajuan']);
    Route::get('table',[HomeController::class, 'lihatFile']);
});