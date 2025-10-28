<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\ReportController;

// Главная страница
Route::get('/', [MainController::class, 'index'])->name('main.index');

// Страница для авторизованных пользователей
Route::get('/home', [HomeController::class, 'index'])->name('home.index');

// Заявки
Route::get('/applications', [ApplicationController::class, 'index'])->name('application.index');

// Билеты
Route::get('/tickets', [TicketController::class, 'index'])->name('ticket.index');

// Отчёты
Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
// О проекте
Route::get('/about', [App\Http\Controllers\AboutController::class, 'index'])->name('about.index');

