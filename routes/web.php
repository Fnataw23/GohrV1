<?php

use Illuminate\Support\Facades\Route;
Auth::routes();
Route::get('/', [App\Http\Controllers\MainController::class, 'index'])->name('/');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
