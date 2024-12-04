<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

//? LOGIN
Route::get('/', [SessionController::class, 'login']);
Route::get('sign-in', [SessionController::class, 'login'])->name('sign-in');
Route::post('sign-in/process', [SessionController::class, 'process_log'])->middleware('XSS')->name('sign-in-process');
Route::get('logout', [SessionController::class, 'logout'])->name('logout');

//? DASHBOARD
Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('checkRole:666');

//? UTILITY
//* ROLES
Route::get('utility/roles/ajaxdataTables', [RoleController::class, 'ajaxdataTables'])->name('rolesList')->middleware('checkRole:1');
Route::get('utility/roles', [RoleController::class, 'index'])->name('rolesIndex')->middleware('checkRole:1');
Route::get('utility/roles/show/{id}', [RoleController::class, 'show'])->name('roleShow')->middleware('checkRole:1');
Route::post('utility/roles/update/{id}', [RoleController::class, 'update'])->name('roleUpdate')->middleware('checkRole:1');
Route::post('utility/roles/store', [RoleController::class, 'store'])->name('roleStore')->middleware('checkRole:1');
Route::post('utility/roles/delete', [RoleController::class, 'destroy'])->name('roleDelete')->middleware('checkRole:1');

//* BRANDS
Route::get('utility/brands/ajaxdataTables', [BrandController::class, 'ajaxdataTables'])->name('brandList')->middleware('checkRole:1');
Route::get('utility/brands', [BrandController::class, 'index'])->name('brandIndex')->middleware('checkRole:1');
Route::get('utility/brands/show/{id}', [BrandController::class, 'show'])->name('brandShow')->middleware('checkRole:1');
Route::post('utility/brands/update/{id}', [BrandController::class, 'update'])->name('brandUpdate')->middleware('checkRole:1');
Route::post('utility/brands/store', [BrandController::class, 'store'])->name('brandStore')->middleware('checkRole:1');
Route::post('utility/brands/delete', [BrandController::class, 'destroy'])->name('brandDelete')->middleware('checkRole:1');

//* MENUS
Route::get('utility/menus/ajaxdataTables', [MenuController::class, 'ajaxdataTables'])->name('menuList')->middleware('checkRole:1');
Route::get('utility/menus', [MenuController::class, 'index'])->name('menuIndex')->middleware('checkRole:1');
Route::get('utility/menus/show/{id}', [MenuController::class, 'show'])->name('menuShow')->middleware('checkRole:1');
Route::post('utility/menus/update/{id}', [MenuController::class, 'update'])->name('menuUpdate')->middleware('checkRole:1');
Route::post('utility/menus/store', [MenuController::class, 'store'])->name('menuStore')->middleware('checkRole:1');
Route::post('utility/menus/delete', [MenuController::class, 'destroy'])->name('menuDelete')->middleware('checkRole:1');

//* USERS
Route::get('utility/users/ajaxdataTables', [UsersController::class, 'ajaxdataTables'])->name('userList')->middleware('checkRole:1');
Route::get('utility/users', [UsersController::class, 'index'])->name('userIndex')->middleware('checkRole:1');
Route::get('utility/users/create', [UsersController::class, 'create'])->name('userCreate')->middleware('checkRole:1');
Route::get('utility/users/edit/{id}', [UsersController::class, 'edit'])->name('userEdit')->middleware('checkRole:1');
Route::post('utility/users/update/{id}', [UsersController::class, 'update'])->name('userUpdate')->middleware('checkRole:1');
Route::post('utility/users/store', [UsersController::class, 'store'])->name('userStore')->middleware('checkRole:1');
Route::post('utility/users/delete', [UsersController::class, 'destroy'])->name('userDelete')->middleware('checkRole:1');
