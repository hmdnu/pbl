<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CrudTestController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfessionCategoryController;
use App\Http\Controllers\ProfessionController;
use App\Http\Controllers\StudentController;
use App\Http\Middleware\AdminAuth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudyProgramController;
use App\Http\Controllers\AlumniUserSurveyController;
use App\Http\Controllers\EmailOtpController;

Route::get('/', fn() => view('welcome'));
Route::get("/login", fn() => view('admin.login'));
Route::post("/post-login", [AuthController::class, 'login']);
Route::get("/logout", [AuthController::class, "logout"]);

Route::middleware([AdminAuth::class])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('study-program', StudyProgramController::class);
    Route::resource('admin', AdminController::class);
    Route::resource('student', StudentController::class);
    Route::resource('profession', ProfessionController::class);
    Route::resource('profession-category', ProfessionCategoryController::class);
});

Route::resource('test-crud', CrudTestController::class);


Route::get('/survey/agreement', [AlumniUserSurveyController::class, 'showAgreement'])->name('survey.agreement');
Route::post('/survey/agreement/submit', [AlumniUserSurveyController::class, 'submitAgreement'])->name('survey.agreement.submit');

Route::get('/survey/form', [AlumniUserSurveyController::class, 'showForm'])->name('survey.form');
Route::post('/survey/form/submit', [AlumniUserSurveyController::class, 'submitSurvey'])->name('survey.form.submit');
