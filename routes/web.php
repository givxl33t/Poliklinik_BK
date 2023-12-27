<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\RiwayatDokterController;
use App\Http\Controllers\AntrianPageController;
use App\Http\Controllers\DokterController;

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

// Route::get('/', function () {
//     return view('landingpage');
// });

Route::get('/' , [LandingPageController::class, 'index']);
Route::get('/antrianpage', [AntrianPageController::class, 'index']);

// AUTH
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class, 'doLogin']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// DOKTER
Route::middleware('auth:web')->group(function () {
    // INDEX PERIKSA
    Route::get('/dokter', [DokterController::class, 'index'])->name('dokterindex');
    Route::get('/jadwalperiksa/add', [DokterController::class, 'createjadwal']);
    Route::post('/jadwalperiksa', [DokterController::class, 'storejadwal']);

    // RIWAYAT PASIEN
    Route::get('/dokter/riwayat', [RiwayatDokterController::class, 'index'])->name('dokterriwayat');

    // PROFIL DOKTER
    Route::get('/dokter/profil', [DokterController::class, 'editdokter']);
    Route::put('/dokter/profil/{id}', [DokterController::class, 'updatedokter']);
});

// ADMIN
Route::middleware('auth:admin')->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('adminindex');

    Route::get('/adminlistpasien', [AdminController::class, 'listpasien'])->name('showlistpasien');
    Route::get('/detailpasien/{id}', [AdminController::class, 'detailpasien'])->name('detailpasien');
    Route::get('/adminlistpasien/{id}/delete', [AdminController::class, 'destroypasien'])->name('deletelistpasien');

    Route::get('/adminlistdokter', [AdminController::class, 'listdokter'])->name('showlistdokter');
    Route::get('/detaildokter/{id}', [AdminController::class, 'detaildokter'])->name('detaildokter');
    Route::get('/adminlistdokter/{id}/delete', [AdminController::class, 'destroydokter'])->name('deletelistdokter');

    Route::get('/adminlistpoli', [AdminController::class, 'listpoli'])->name('showlistpoli');
    Route::get('/detailpoli/{id}', [AdminController::class, 'detailpoli'])->name('detailpoli');
    Route::get('/adminlistpoli/{id}/delete', [AdminController::class, 'destroypoli'])->name('deletelistpoli');

    Route::get('/adminlistobat', [AdminController::class, 'listobat'])->name('showlistobat');
    Route::get('/adminlistobat/add', [AdminController::class, 'createobat']);
    Route::post('/adminlistobat', [AdminController::class, 'storeobat']);
    Route::get('/adminlistobat/{id}/edit', [AdminController::class, 'editobat']);
    Route::put('/adminlistobat/{id}', [AdminController::class, 'updateobat']);
    Route::get('/adminlistobat/{id}/delete', [AdminController::class, 'destroyobat'])->name('deletelistobat');
});