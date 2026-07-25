<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AlertController;
use App\Http\Controllers\InformasiController;
use App\Http\Controllers\ReportController;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

// Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Kelola Akun (Mahasiswa / Satpam / Admin)
Route::resource('users', UserController::class)->except(['show']);

// Informasi / Pengumuman Darurat (dikirim Satpam, tampil di APK Mahasiswa)
Route::resource('alerts', AlertController::class)->except(['show']);

// Informasi Keamanan
Route::resource('informasi', InformasiController::class)->except(['show']);

// Laporan Mahasiswa
Route::get('/reports', [ReportController::class, 'webIndex'])->name('reports.index');
Route::put('/reports/{report}/status', [ReportController::class, 'webUpdateStatus'])->name('reports.updateStatus');