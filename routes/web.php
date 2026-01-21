<?php

use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\ArtikelHoaksController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ArtikelHoaksController::class, 'landing'])->name('landing');
Route::view('/lapor-hoax', 'lapor-hoax')->name('lapor.hoax');

Route::get('/artikel', [ArtikelHoaksController::class, 'publicIndex'])->name('artikel.index');
Route::get('/artikel/{artikel}', [ArtikelHoaksController::class, 'publicShow'])->name('artikel.show');

Route::get('/admin/login', [AdminAuthController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login.submit');
Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

Route::middleware('admin.auth')->prefix('admin')->group(function () {
    Route::get('/artikel', [ArtikelHoaksController::class, 'adminIndex'])->name('admin.artikel.index');
    Route::get('/artikel/create', [ArtikelHoaksController::class, 'create'])->name('admin.artikel.create');
    Route::post('/artikel', [ArtikelHoaksController::class, 'store'])->name('admin.artikel.store');
    Route::get('/artikel/{artikel}/edit', [ArtikelHoaksController::class, 'edit'])->name('admin.artikel.edit');
    Route::put('/artikel/{artikel}', [ArtikelHoaksController::class, 'update'])->name('admin.artikel.update');
    Route::delete('/artikel/{artikel}', [ArtikelHoaksController::class, 'destroy'])->name('admin.artikel.destroy');
});
