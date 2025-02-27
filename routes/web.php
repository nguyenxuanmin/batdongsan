<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AdminAuth;
use App\Http\Middleware\LoginAuth;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BlogController;

Route::group(['middleware' => [AdminAuth::class]], function () {
    Route::get('/admin', [DashboardController::class, 'index'])->name('admin');
    Route::get('/admin/logout', [AdminController::class, 'logout'])->name('logout');
    Route::get('/blog', [BlogController::class, 'index'])->name('list_blog');
    Route::get('/add-blog', [BlogController::class, 'add'])->name('add_blog');
    Route::post('/save-blog', [BlogController::class, 'save'])->name('save_blog');
    Route::post('/delete-blog', [BlogController::class, 'delete'])->name('delete_blog');
    Route::get('/edit-blog/{id}', [BlogController::class, 'edit'])->name('edit_blog');
});
Route::group(['middleware' => [LoginAuth::class]], function () {
    Route::get('/admin/login', function () {return view('admin.login');})->name('login');
    Route::post('/admin/login', [AdminController::class, 'login'])->name('login');
    Route::get('/admin/signup', function () {return view('admin.signup');})->name('signup');
    Route::post('/admin/signup', [AdminController::class, 'signup'])->name('signup');
});
