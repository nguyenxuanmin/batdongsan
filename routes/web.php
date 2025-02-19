<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AdminAuth;
use App\Http\Middleware\LoginAuth;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AdminController;

Route::group(['middleware' => [AdminAuth::class]], function () {
    Route::get('/admin', [DashboardController::class, 'index'])->name('admin');
    Route::get('/admin/logout', [AdminController::class, 'logout'])->name('logout');
});
Route::group(['middleware' => [LoginAuth::class]], function () {
    Route::get('/admin/login', function () {return view('admin.login');})->name('login');
    Route::post('/admin/login', [AdminController::class, 'login'])->name('login');
    Route::get('/admin/signup', function () {return view('admin.signup');})->name('signup');
    Route::post('/admin/signup', [AdminController::class, 'signup'])->name('signup');
});
