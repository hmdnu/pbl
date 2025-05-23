<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AlumniSurveyController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CrudTestController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UniqueUrlController;
use App\Http\Controllers\ProfessionCategoryController;
use App\Http\Controllers\ProfessionController;
use App\Http\Controllers\StudentController;
use App\Http\Middleware\AdminAuth;
use App\Http\Middleware\VerifyUserForm;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudyProgramController;
use App\Http\Controllers\AlumniUserSurveyController;
use Illuminate\Support\Facades\Redis;

Route::get('/', fn() => view('welcome'));
Route::get("/login", fn() => view('admin.login'));
Route::post("/login", [AuthController::class, 'login']);
Route::get("/logout", [AuthController::class, "logout"]);

Route::middleware([AdminAuth::class])->group(function () {
    Route::prefix('/dashboard')->group(function () {
        Route::get('/spread', [DashboardController::class, 'showSpread'])->name('dashboard.spread');
        Route::get('/evaluation', [DashboardController::class, 'showEvaluation'])->name('dashboard.evaluation');
        Route::get('/wait-periode', [DashboardController::class, 'showWaitPeriode'])->name('dashboard.wait-periode');

        Route::prefix('/data')->group(function () {
            Route::get('/spread', [DashboardController::class, 'spread'])->name('dashboard.data.spread');
        });
    });

    Route::resource('student', StudentController::class);
    Route::resource('study-program', StudyProgramController::class);
    Route::resource('admin', AdminController::class);
    Route::resource('profession', ProfessionController::class);
    Route::resource('profession-category', ProfessionCategoryController::class);
});

Route::prefix('/survey')->group(function () {
    Route::prefix('/alumni-user')->group(function () {
        Route::get('/agreement', fn() => view('survey.alumni_users.agreement'))->name('view.alumni-user.agreement');
        Route::post('/send-email/{role}', [UniqueUrlController::class, 'sendEmail'])->name('post.alumni-user.send-email');
    });
    Route::prefix('/alumni')->group(function () {
        Route::get('/validation', fn() => view('survey.alumni.validation'))->name('view.alumni.validation');
        Route::post('/send-email/{role}', [UniqueUrlController::class, 'sendEmail'])->name('post.alumni.send-email');
    });

    Route::middleware([VerifyUserForm::class])->group(function () {
        Route::get('/form/alumni-user/{code}', fn($code) => view('survey.alumni_users.form'))->name('view.alumni-user.form');
        Route::get('/form/alumni/{code}', fn($code) => view('survey.alumni.form'))->name('view.alumni.form');
    });

    Route::get('/validation/form/{role}/{code}', [UniqueUrlController::class, 'redirectPage']);
});

Route::resource('test-crud', CrudTestController::class);