<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\CompanyController; 

Route::get('/', function () {
    return Inertia::render('App');
})->name('home');
Route::get('/index', function () {
    return Inertia::render('App');
})->name('home');
Route::get('/services', function () {
    return Inertia::render('Services');
})->name('services');
Route::get('/company', function () {
    return Inertia::render('Company');
})->name('company');
Route::prefix('company')->group(function () {
    Route::get('/about', [CompanyController::class, 'about'])->name('company.about');
    Route::get('/documents', [CompanyController::class, 'documents'])->name('company.documents');
    Route::get('/financial-reports', [CompanyController::class, 'financialReports'])->name('company.financial-reports');
    Route::get('/annual-procurement', [CompanyController::class, 'annualProcurement'])->name('company.annual-procurement');
    Route::get('/disclosure', [CompanyController::class, 'disclosure'])->name('company.disclosure');
    Route::get('/development-plan', [CompanyController::class, 'developmentPlan'])->name('company.development-plan');
    Route::get('/meeting-minutes', [CompanyController::class, 'meetingMinutes'])->name('company.meeting-minutes');
    Route::get('/requisites', [CompanyController::class, 'requisites'])->name('company.requisites');
});

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
