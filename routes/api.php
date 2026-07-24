<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AlertController;
use App\Http\Controllers\ReportController;

// === AUTH ===
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', function (\Illuminate\Http\Request $request) {
        return $request->user();
    });

    // === ALERTS (Satpam kirim, butuh login) ===
    Route::post('/alerts', [AlertController::class, 'apiStore']);

    // === REPORTS (Mahasiswa & Satpam, butuh login) ===
    Route::post('/reports', [ReportController::class, 'store']);
    Route::get('/reports', [ReportController::class, 'index']);
    Route::get('/reports/{report}', [ReportController::class, 'show']);
    Route::put('/reports/{report}/status', [ReportController::class, 'updateStatus']);
});

// === ALERTS (Semua orang boleh lihat, tanpa login) ===
Route::get('/alerts', [AlertController::class, 'apiIndex']);