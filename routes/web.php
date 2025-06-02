<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PlantController;
use App\Http\Controllers\SensorController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;

// 1) Plant CRUD
Route::resource('plants', PlantController::class);

// 2) Global “All Sensors” index
//    URL: GET /sensors
//    Controller: SensorController@globalIndex
Route::get('/sensors', [SensorController::class, 'globalIndex'])
     ->name('sensors.globalIndex');

// 3) Nested Sensors under a specific Plant
//    URLs: /plants/{plant}/sensors/…
Route::resource('plants.sensors', SensorController::class);

// 4) Global “All Transactions” index
//    URL: GET /transactions
//    Controller: TransactionController@globalIndex
Route::get('/transactions', [TransactionController::class, 'globalIndex'])
     ->name('transactions.globalIndex');

// 5) Nested Transactions under a specific Sensor
//    URLs: /sensors/{sensor}/transactions/…
Route::resource('sensors.transactions', TransactionController::class)
     ->parameters(['transactions' => 'transaction']);

// 6) Export Plants as PDF
Route::get('/plants/export/pdf', [PlantController::class, 'exportPDF'])
     ->name('plants.exportPDF');

// 7) Public welcome page
Route::get('/', fn() => view('welcome'));

// 8) Dashboard (requires auth & email‐verified)
Route::get('/dashboard', fn() => view('dashboard'))
     ->middleware(['auth', 'verified'])
     ->name('dashboard');

// 9) Profile management (authenticated)
Route::middleware('auth')->group(function () {
    Route::get('/profile',   [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile',   [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile',[ProfileController::class, 'destroy'])->name('profile.destroy');
});

// 10) Auth scaffolding routes (login/register/etc.)
require __DIR__.'/auth.php';