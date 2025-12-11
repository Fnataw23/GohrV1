<?php

use App\Http\Controllers\Application\StepForms\FinishController;
use App\Http\Controllers\Application\StepForms\Step1Controller;
use App\Http\Controllers\Application\StepForms\Step2Controller;
use App\Http\Controllers\Application\StepForms\Step3Controller;
use App\Http\Controllers\Application\StepForms\Step4Controller;
use App\Http\Controllers\Application\StepForms\Step5Controller;
use App\Http\Controllers\Application\StepForms\Step6Controller;
use App\Http\Controllers\Application\StepForms\Step7Controller;
use App\Http\Controllers\Application\StepForms\ConfirmController;
use App\Http\Controllers\Application\StepForms\IndexController;
use App\Http\Controllers\Application\StepForms\ShowController;
use App\Http\Controllers\Front\MainController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Главная страница
Route::get('/', [MainController::class, 'index'])->name('main.index');

// Защищенные маршруты (требуют только аутентификации)
Route::middleware(['auth'])->group(function () {
    // Дашборд Breeze (можно удалить если не нужен)
    Route::get('/dashboard', function () {
        return redirect()->intended(route('applications.index'));
    })->name('dashboard');

    // Страница для авторизованных пользователей
    Route::get('/home', [HomeController::class, 'index'])->name('home.index');

    // Маршруты для заявок
    Route::prefix('applications')->name('applications.')->group(function () {
        // Список всех заявок
        Route::get('/', [IndexController::class, '__invoke'])->name('index');

        // Просмотр конкретной заявки
        Route::get('/{application}', [ShowController::class, '__invoke'])->name('show');

        // Создание заявки (шаги 1-7)
        Route::get('/create/step1', [Step1Controller::class, 'show'])->name('create.step1');
        Route::post('/create/step1', [Step1Controller::class, 'store'])->name('store.step1');

        Route::get('/create/step2', [Step2Controller::class, 'show'])->name('create.step2');
        Route::post('/create/step2', [Step2Controller::class, 'store'])->name('store.step2');

        Route::get('/create/step3', [Step3Controller::class, 'show'])->name('create.step3');
        Route::post('/create/step3', [Step3Controller::class, 'store'])->name('store.step3');

        Route::get('/create/step4', [Step4Controller::class, 'show'])->name('create.step4');
        Route::post('/create/step4', [Step4Controller::class, 'store'])->name('store.step4');

        Route::get('/create/step5', [Step5Controller::class, 'show'])->name('create.step5');
        Route::post('/create/step5', [Step5Controller::class, 'store'])->name('store.step5');

        Route::get('/create/step6', [Step6Controller::class, 'show'])->name('create.step6');
        Route::post('/create/step6', [Step6Controller::class, 'store'])->name('store.step6');

        Route::get('/create/step7', [Step7Controller::class, 'show'])->name('create.step7');
        Route::post('/create/step7', [Step7Controller::class, 'store'])->name('store.step7');

        // Подтверждение заявки
        Route::get('/create/confirm', [ConfirmController::class, '__invoke'])->name('create.confirm');

        // Финиш - сохранение заявки
        Route::post('/create/finish', [FinishController::class, '__invoke'])->name('store.finish');
    });

    // Билеты
    Route::get('/tickets', [TicketController::class, 'index'])->name('ticket.index');
    Route::get('/tickets/create', [TicketController::class, 'create'])->name('ticket.create');

    // Отчёты
    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');

    // Профиль Breeze
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// О проекте - публичный маршрут
Route::get('/about', [AboutController::class, 'index'])->name('about.index');

// Маршруты аутентификации Breeze
require __DIR__.'/auth.php';
