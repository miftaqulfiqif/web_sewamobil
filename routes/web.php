<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PenyewaanController;
use Illuminate\Support\Facades\Route;

use function Ramsey\Uuid\v1;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function () {
    return view('auth.login');
});
Route::post('/login', [AuthController::class, 'login'])->name('login');


Route::get('/registration', function () {
    return view('auth.registration');
});
Route::post('/registration', [AuthController::class, 'store'])->name('register');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/peminjaman', [PenyewaanController::class, 'index'])->name('peminjaman');
Route::post('/peminjaman/cek', [PenyewaanController::class, 'cekMobil'])->name('cek_mobil');
Route::post('/peminjaman/pinjam', [PenyewaanController::class, 'store'])->name('pinjam_mobil');

Route::post('/pengembalian', [PenyewaanController::class, 'pengembalian'])->name('pengembalian');


Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
