<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfessionCategoryController;
use App\Http\Controllers\ProfessionController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudyProgramController;
use App\Http\Controllers\SurveyController;
use App\Http\Controllers\EmailOtpController;

Route::get('/', fn() => view('welcome'));

// TODO
// alumni/alumni user survey routes -> view, post
// protected route for admin
// email otp route

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::resource('study-program', StudyProgramController::class);
Route::resource('admin', AdminController::class);
Route::resource('student', StudentController::class);
Route::resource('profession', ProfessionController::class);
Route::resource('profession-category', ProfessionCategoryController::class);

Route::get('/survey/agreement', [SurveyController::class, 'showAgreement'])->name('survey.agreement');
Route::post('/survey/send-otp', [SurveyController::class, 'sendOtp'])->name('survey.sendOtp');
Route::post('/survey/agreement', [SurveyController::class, 'submitAgreement'])->name('survey.agreement.submit');

Route::get('/survey/form', [SurveyController::class, 'showForm'])->name('survey.form');
Route::post('/survey/form', [SurveyController::class, 'submitSurvey'])->name('survey.form.submit');
