<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\RiwayatDokterController;
use App\Http\Controllers\AntrianPageController;
use App\Http\Controllers\DokterController;
use App\Http\Controllers\PeriksaController;

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

Route::get('/' , [LandingPageController::class, 'index'])->name('landingpage');
Route::post('/' , [LandingPageController::class, 'storepasien']);
Route::post('/cekrekammedis' , [LandingPageController::class, 'cekrekammedis']);
Route::post('/daftarpoli' , [LandingPageController::class, 'storedaftarpoli']);
Route::get('/antrianpage', [AntrianPageController::class, 'index']);

// AUTH
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class, 'doLogin']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// DOKTER
Route::middleware('auth:web')->group(function () {
    // INDEX JADWAL PERIKSA
    Route::get('/dokter', [DokterController::class, 'index'])->name('dokterindex');
    Route::get('/jadwalperiksa/add', [DokterController::class, 'createjadwal']);
    Route::post('/jadwalperiksa', [DokterController::class, 'storejadwal']);
    Route::get('/jadwalperiksa/detailjadwalperiksa/{id}', [DokterController::class, 'detailjadwalperiksa']);
    Route::get('/jadwalperiksa/detailjadwalperiksa/{id}/edit', [DokterController::class, 'editjadwal']);
    Route::put('/jadwalperiksa/detailjadwalperiksa/{id}', [DokterController::class, 'updatejadwal']);

    // PERIKSA PASIEN
    Route::get('/dokter/periksa', [PeriksaController::class, 'index'])->name('dokterperiksa');
    Route::get('/dokter/periksa/detailpasien/{id}', [PeriksaController::class, 'detailpasien']);
    Route::get('/dokter/periksa/detailpasien/{iddaftarpoli}/add', [PeriksaController::class, 'createperiksa']);
    Route::post('/dokter/periksa/detailpasien', [PeriksaController::class, 'storeperiksa']);
    Route::get('/dokter/periksa/detailpasien/{id}/edit', [PeriksaController::class, 'editperiksa']);
    Route::put('/dokter/periksa/detailpasien/{id}', [PeriksaController::class, 'updateperiksa']);

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
    Route::get('/adminlistpasien/add', [AdminController::class, 'createpasien']);
    Route::post('/adminlistpasien', [AdminController::class, 'storepasien']);
    Route::get('/adminlistpasien/{id}/edit', [AdminController::class, 'editpasien']);
    Route::put('/adminlistpasien/{id}', [AdminController::class, 'updatepasien']);
    Route::get('/adminlistpasien/{id}/delete', [AdminController::class, 'destroypasien'])->name('deletelistpasien');

    Route::get('/adminlistdokter', [AdminController::class, 'listdokter'])->name('showlistdokter');
    Route::get('/detaildokter/{id}', [AdminController::class, 'detaildokter'])->name('detaildokter');
    Route::get('/adminlistdokter/add', [AdminController::class, 'createdokter']);
    Route::post('/adminlistdokter', [AdminController::class, 'storedokter']);
    Route::get('/adminlistdokter/{id}/edit', [AdminController::class, 'editdokter']);
    Route::put('/adminlistdokter/{id}', [AdminController::class, 'updatedokter']);
    Route::get('/adminlistdokter/{id}/delete', [AdminController::class, 'destroydokter'])->name('deletelistdokter');

    Route::get('/adminlistpoli', [AdminController::class, 'listpoli'])->name('showlistpoli');
    Route::get('/detailpoli/{id}', [AdminController::class, 'detailpoli'])->name('detailpoli');
    Route::get('/adminlistpoli/add', [AdminController::class, 'createpoli']);
    Route::post('/adminlistpoli', [AdminController::class, 'storepoli']);
    Route::get('/adminlistpoli/{id}/edit', [AdminController::class, 'editpoli']);
    Route::put('/adminlistpoli/{id}', [AdminController::class, 'updatepoli']);
    Route::get('/adminlistpoli/{id}/delete', [AdminController::class, 'destroypoli'])->name('deletelistpoli');

    Route::get('/adminlistobat', [AdminController::class, 'listobat'])->name('showlistobat');
    Route::get('/adminlistobat/add', [AdminController::class, 'createobat']);
    Route::post('/adminlistobat', [AdminController::class, 'storeobat']);
    Route::get('/adminlistobat/{id}/edit', [AdminController::class, 'editobat']);
    Route::put('/adminlistobat/{id}', [AdminController::class, 'updateobat']);
    Route::get('/adminlistobat/{id}/delete', [AdminController::class, 'destroyobat'])->name('deletelistobat');
});