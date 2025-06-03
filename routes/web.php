<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PlantController;
use App\Http\Controllers\SensorController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// 1) Plant CRUD
Route::resource('plants', PlantController::class);

// 2) Global “All Sensors” index
Route::get('/sensors', [SensorController::class, 'globalIndex'])
     ->name('sensors.globalIndex');

// 2.1) Export Sensors as PDF
Route::get('/sensors/export/pdf', [SensorController::class, 'downloadPdf'])
     ->name('sensors.pdf');

// 3) Nested Sensors under a specific Plant
Route::resource('plants.sensors', SensorController::class);

// 4) Global “All Transactions” index
Route::get('/transactions', [TransactionController::class, 'globalIndex'])
     ->name('transactions.globalIndex');

// 4.1) Export Transactions as PDF
Route::get('/transactions/export/pdf', [TransactionController::class, 'exportPDF'])
     ->name('transactions.exportPDF');

// 5) Nested Transactions under a specific Sensor
Route::resource('sensors.transactions', TransactionController::class)
     ->parameters(['transactions' => 'transaction']);

// 6) Export Plants as PDF
Route::get('/plants/export/pdf', [PlantController::class, 'exportPDF'])
     ->name('plants.exportPDF');

// 7) Public welcome page
Route::get('/', fn() => view('welcome'));

// Updated user page route to use UserController@index
Route::get('/users/index', [UserController::class, 'index'])
    ->middleware(['auth'])
    ->name('user');

Route::resource('users', UserController::class);

// 8) Routes that require authentication
Route::middleware('auth')->group(function () {

     // Profile management
     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
     Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

     // Dashboard route (requires verified email)
     Route::get('/dashboard', [DashboardController::class, 'index'])
          ->middleware('verified')
          ->name('dashboard');
});

// 9) Authentication scaffolding routes (login/register/etc.)
require __DIR__ . '/auth.php';