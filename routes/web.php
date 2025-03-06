<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AdminAuth;
use App\Http\Middleware\LoginAuth;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\SetupController;

Route::group(['middleware' => [AdminAuth::class]], function () {
    Route::get('/admin', [DashboardController::class, 'index'])->name('admin');
    Route::get('/admin/logout', [AdminController::class, 'logout'])->name('logout');
    Route::get('/news', [BlogController::class, 'index'])->name('list_news');
    Route::get('/news/add-blog', [BlogController::class, 'add'])->name('add_news');
    Route::post('/news/save-blog', [BlogController::class, 'save'])->name('save_news');
    Route::post('/news/delete-blog', [BlogController::class, 'delete'])->name('delete_news');
    Route::get('/news/edit-blog/{id}', [BlogController::class, 'edit'])->name('edit_news');
    Route::get('/about_us', [BlogController::class, 'index'])->name('list_about_us');
    Route::get('/about_us/add-about-us', [BlogController::class, 'add'])->name('add_about_us');
    Route::post('/about_us/save-about-us', [BlogController::class, 'save'])->name('save_about_us');
    Route::post('/about_us/delete-about-us', [BlogController::class, 'delete'])->name('delete_about_us');
    Route::get('/about_us/edit-about-us/{id}', [BlogController::class, 'edit'])->name('edit_about_us');
    Route::get('/service', [BlogController::class, 'index'])->name('list_service');
    Route::get('/service/add-service', [BlogController::class, 'add'])->name('add_service');
    Route::post('/service/save-service', [BlogController::class, 'save'])->name('save_service');
    Route::post('/service/delete-service', [BlogController::class, 'delete'])->name('delete_service');
    Route::get('/service/edit-service/{id}', [BlogController::class, 'edit'])->name('edit_service');
    Route::get('/setup_column', [SetupController::class, 'index'])->name('setup_column');
    Route::post('/save_setup', [SetupController::class, 'save'])->name('save_setup');
});
Route::group(['middleware' => [LoginAuth::class]], function () {
    Route::get('/admin/login', function () {return view('admin.login');})->name('login');
    Route::post('/admin/login', [AdminController::class, 'login'])->name('login');
    Route::get('/admin/signup', function () {return view('admin.signup');})->name('signup');
    Route::post('/admin/signup', [AdminController::class, 'signup'])->name('signup');
});
