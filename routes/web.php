<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AlumniSurveyController;
use App\Http\Controllers\AlumniUserSurveyController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CrudTestController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfessionCategoryController;
use App\Http\Controllers\ProfessionController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\StudyProgramController;
use App\Http\Controllers\UniqueUrlController;
use App\Http\Middleware\AdminAuth;
use App\Http\Middleware\VerifyUserForm;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');
Route::view("/login", 'admin.login');
Route::post("/login", [AuthController::class, 'login']);
Route::get("/logout", [AuthController::class, "logout"]);

Route::middleware([AdminAuth::class])->group(function () {
    Route::prefix('/dashboard')->group(function () {
        Route::get('/spread', [DashboardController::class, 'showSpread'])->name('dashboard.spread');
        Route::get('/institution-type', [DashboardController::class, 'showSpreadInstitution'])->name('dashboard.institution-type');
        Route::get('/evaluation', [DashboardController::class, 'showEvaluation'])->name('dashboard.evaluation');
        Route::get('/wait-period', [DashboardController::class, 'showWaitPeriode'])->name('dashboard.wait-periode');

        Route::prefix('/data')->group(function () {
            Route::get('/spread', [DashboardController::class, 'spread'])->name('dashboard.data.spread');
            Route::get('/spread-table', [DashboardController::class, 'spreadTable'])->name('dashboard.data.spread-table');
            Route::get('/evaluation', [DashboardController::class, 'evaluation'])->name('dashboard.data.evaluation');
            Route::get('/wait-period', [DashboardController::class, 'waitperiodData'])->name('dashboard.data.wait-periode');
            Route::get('/institution-type', [DashboardController::class, 'getInstitutionTypeSpread'])->name('dashboard.data.institution-type');
        });

        Route::prefix('/download')->group(function () {
            Route::get('/alumni-survey/recap', [AlumniSurveyController::class, 'exportAlumniSurveyRecap'])->name('dashboard.download.alumni-survey.recap');
            Route::get('/alumni-user-survey/recap', [])->name('dashboard.download.alumni-user-survey.recap');
        });

        Route::view('/alumni-survey/recap', 'admin.dashboard.alumni_recap');
        Route::view('/alumni-user-survey/recap', 'admin.dashboard.alumni_user_recap');
        Route::view('/alumni-survey/unfilled', 'admin.dashboard.alumni_recap_unfilled');
        Route::view('/alumni-user-survey/unfilled', 'admin.dashboard.alumni_user_recap_unfilled');
    });

    Route::resource('student', StudentController::class);
    Route::resource('study-program', StudyProgramController::class);
    Route::resource('admin', AdminController::class);
    Route::resource('profession', ProfessionController::class);
    Route::resource('profession-category', ProfessionCategoryController::class);
});

Route::prefix('/survey')->group(function () {
    Route::prefix('/alumni-user')->group(function () {
        Route::view('/agreement', 'survey.alumni_users.agreement')->name('view.alumni-user.agreement');
        Route::post('/send-email/{role}', [UniqueUrlController::class, 'sendEmail'])->name('post.alumni-user.send-email');
    });

    Route::prefix('/alumni')->group(function () {
        Route::view('/validation', 'survey.alumni.validation')->name('view.alumni.validation');
        Route::post('/send-email/{role}', [UniqueUrlController::class, 'sendEmail'])->name('post.alumni.send-email');
    });

    Route::middleware([VerifyUserForm::class])->group(function () {
        Route::get('/form/alumni-user/{code}', [AlumniUserSurveyController::class, 'index'])->name('view.alumni-user.form');
        Route::post('/form/alumni-user/{code}', [AlumniUserSurveyController::class, 'store'])->name('post.alumni-user.form');

        Route::get('/form/alumni/{code}', [AlumniSurveyController::class, 'index'])->name('view.alumni.form');
        Route::post('/form/alumni/{code}', [AlumniSurveyController::class, 'storeFirstForm'])->name('post.alumni.form');
        Route::get('/form/alumni/{code}/2/{category}', [AlumniSurveyController::class, 'secondForm'])->name('view.alumni.form.2');
        Route::post('/form/alumni/{code}/2', [AlumniSurveyController::class, 'storeSecondForm'])->name('post.alumni.form.2');
    });

    Route::view('/done', 'survey.alumni.done')->name('view.alumni.done');
});

Route::resource('test-crud', CrudTestController::class);
