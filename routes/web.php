<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfessionCategoryController;
use App\Http\Controllers\ProfessionController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudyProgramController;
use App\Http\Controllers\EmailOtpController;

Route::get('/', fn() => view('welcome'));

// TODO
// alumni/alumno user survey routes -> view, post
// protected route for admin
// email otp route
Route::get('/alumni', [EmailOtpController::class, 'showform'])->name('alumni.form');


// Menampilkan form (GET)
Route::get('/form', [StudentController::class, 'showform'])->name('alumni.survey.form');

// Menangani submit form (POST)
Route::post('/form', [StudentController::class, 'submit'])->name('alumni.survey.submit');


Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::resource('study-program', StudyProgramController::class);
Route::resource('admin', AdminController::class);
Route::resource('student', StudentController::class);
Route::resource('profession', ProfessionController::class);
Route::resource('profession-category', ProfessionCategoryController::class);
 