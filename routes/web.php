<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SessionController;
use Illuminate\Support\Facades\Route;

//? LOGIN
Route::get('/', [SessionController::class, 'login']);
Route::get('sign-in', [SessionController::class, 'login'])->name('sign-in');
Route::post('sign-in/process', [SessionController::class, 'process_log'])->middleware('XSS')->name('sign-in-process');
Route::get('logout', [SessionController::class, 'logout'])->name('logout');

//? DASHBOARD
Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('checkRole:666');
