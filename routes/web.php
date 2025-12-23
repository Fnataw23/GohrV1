<?php

use App\Http\Controllers\Application\EditController;
use App\Http\Controllers\Application\ShowController;
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
use App\Http\Controllers\Front\MainController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingsController;
use Illuminate\Support\Facades\Route;

// Защищённые маршруты (требуют аутентификации)
Route::middleware(['auth'])->group(function () {

    // Дашборд
    Route::get('/dashboard', function () {
        return redirect()->route('main.index');
    })->name('dashboard');

    // Главная страница
    Route::get('/', [MainController::class, 'index'])->name('main.index');

    // Заявки
    Route::prefix('applications')->name('applications.')->group(function () {
        Route::get('/{application}', [ShowController::class, '__invoke'])->name('show');
        Route::get('/{application}/edit', [EditController::class, 'edit'])->name('edit');

        Route::patch('/{application}', [EditController::class, 'update'])->name('update');

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

        Route::get('/create/confirm', [ConfirmController::class, '__invoke'])->name('create.confirm');
        Route::post('/create/finish', [FinishController::class, '__invoke'])->name('store.finish');


    });
    // Отчёты
    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
    Route::get('/settings', [SettingsController::class, 'index'])
        ->name('settings.index');

    Route::patch('/settings', [SettingsController::class, 'update'])
        ->name('settings.update');

    // Профиль Breeze
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Подключаем маршруты аутентификации Breeze
require __DIR__.'/auth.php';
