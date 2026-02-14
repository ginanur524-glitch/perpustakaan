<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

/* PUBLIK */
Route::get('/', [HomeController::class, 'index']);
Route::get('/search', [HomeController::class, 'search']);

/* AUTH */
Auth::routes();



Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', [AdminController::class, 'dashboard']);

    // CRUD Buku
    Route::get('/buku', [AdminController::class, 'buku']);
    Route::post('/buku', [AdminController::class, 'storeBuku']);
    Route::get('/buku/{id}/hapus', [AdminController::class, 'deleteBuku']);
    Route::get('/buku/{id}/edit', [AdminController::class, 'editBuku']);
    Route::post('/buku/{id}/update', [AdminController::class, 'updateBuku']);

    // Peminjaman
    Route::get('/peminjaman', [AdminController::class, 'peminjaman']);
    Route::post('/peminjaman', [AdminController::class, 'storePeminjaman']);
    Route::get('/peminjaman/{id}/kembali', [AdminController::class, 'kembalikan']);

    //CRUD SISWA 
Route::get('/siswa', [AdminController::class, 'siswa']);
Route::post('/siswa', [AdminController::class, 'storeSiswa']);
Route::get('/siswa/{id}', [AdminController::class, 'detailSiswa']);
Route::get('/siswa/{id}/hapus', [AdminController::class, 'deleteSiswa']);
Route::get('/siswa/{id}/edit', [AdminController::class, 'editSiswa']);
Route::post('/siswa/{id}/update', [AdminController::class, 'updateSiswa']);
Route::get('/siswa/{id}/detail', [AdminController::class, 'detailSiswa']);

Route::get('/peminjaman/export', [AdminController::class, 'exportPeminjaman']);
Route::get('/peminjaman/export/pdf', [AdminController::class, 'exportPdf']);


});
