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
    Route::get('/blog/add-blog', [BlogController::class, 'add'])->name('add_blog');
    Route::post('/blog/save-blog', [BlogController::class, 'save'])->name('save_blog');
    Route::post('/blog/delete-blog', [BlogController::class, 'delete'])->name('delete_blog');
    Route::get('/blog/edit-blog/{id}', [BlogController::class, 'edit'])->name('edit_blog');
    Route::get('/about_us', [BlogController::class, 'index'])->name('list_about_us');
    Route::get('/about_us/add-about-us', [BlogController::class, 'add'])->name('add_about_us');
    Route::post('/about_us/save-about-us', [BlogController::class, 'save'])->name('save_about_us');
    Route::post('/about_us/delete-about-us', [BlogController::class, 'delete'])->name('delete_about_us');
    Route::get('/about_us/edit-about-us/{id}', [BlogController::class, 'edit'])->name('edit_about_us');
});
Route::group(['middleware' => [LoginAuth::class]], function () {
    Route::get('/admin/login', function () {return view('admin.login');})->name('login');
    Route::post('/admin/login', [AdminController::class, 'login'])->name('login');
    Route::get('/admin/signup', function () {return view('admin.signup');})->name('signup');
    Route::post('/admin/signup', [AdminController::class, 'signup'])->name('signup');
});
