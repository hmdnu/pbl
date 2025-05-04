<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfessionCategoryController;
use App\Http\Controllers\ProfessionController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudyProgramController;

Route::get('/', fn() => view('welcome'));

// TODO
// alumni/alumno user survey routes -> view, post
// protected route for admin
// email otp route

Route::resource('study-program', StudyProgramController::class);
Route::resource('admin', AdminController::class);
Route::resource('student', StudentController::class);
Route::resource('profession', ProfessionController::class);
Route::resource('profession-category', ProfessionCategoryController::class);
