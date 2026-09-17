<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\AcademicYearController;
use App\Http\Controllers\FeeCategoryController;
use App\Http\Controllers\FeeRateController;
use App\Http\Controllers\BillingController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ImportController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return redirect()->route('dashboard');
});

/*
|--------------------------------------------------------------------------
| Dashboard
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

/*
|--------------------------------------------------------------------------
| Master Data
|--------------------------------------------------------------------------
*/

Route::resource('students', StudentController::class);

Route::resource('classes', ClassController::class);

Route::resource('academic-years', AcademicYearController::class);

Route::resource('fee-categories', FeeCategoryController::class);

Route::resource('fee-rates', FeeRateController::class);

/*
|--------------------------------------------------------------------------
| Billing
|--------------------------------------------------------------------------
*/

Route::resource('billings', BillingController::class);

Route::get('/billings/generate', [BillingController::class, 'generate'])
    ->name('billings.generate');

/*
|--------------------------------------------------------------------------
| Reports
|--------------------------------------------------------------------------
*/

Route::get('/reports', [ReportController::class, 'index'])
    ->name('reports.index');

Route::get('/reports/student', [ReportController::class, 'student'])
    ->name('reports.student');

Route::get('/reports/monthly', [ReportController::class, 'monthly'])
    ->name('reports.monthly');

Route::get('/reports/yearly', [ReportController::class, 'yearly'])
    ->name('reports.yearly');

/*
|--------------------------------------------------------------------------
| Import Students
|--------------------------------------------------------------------------
*/

Route::prefix('imports')->group(function () {

    Route::get('/students', [ImportController::class, 'index'])
        ->name('imports.students');

    Route::post('/students', [ImportController::class, 'store'])
        ->name('imports.students.store');

    // Tambahkan di sini
    Route::get('/students/template', [ImportController::class, 'template'])
        ->name('students.template');

    Route::get('/history', [ImportController::class, 'history'])
        ->name('imports.history');

    Route::get('/history', [ImportController::class, 'history'])
        ->name('imports.history');

});