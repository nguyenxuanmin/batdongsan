<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;

Route::get('/admin', [DashboardController::class, 'index'])->name('admin');
