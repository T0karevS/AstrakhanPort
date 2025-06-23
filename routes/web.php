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
Route::get('/contacts', function () {
    return Inertia::render('Contacts');
})->name('contacts');
Route::get('/company', function () {
    return Inertia::render('Company');
})->name('company');
// Route::prefix('company')->group(function () {
//     Route::get('/about', [CompanyController::class, 'about'])->name('company.about');
//     Route::get('/documents', [CompanyController::class, 'documents'])->name('company.documents');
//     Route::get('/financial-reports', [CompanyController::class, 'financialReports'])->name('company.financial-reports');
//     Route::get('/annual-procurement', [CompanyController::class, 'annualProcurement'])->name('company.annual-procurement');
//     Route::get('/disclosure', [CompanyController::class, 'disclosure'])->name('company.disclosure');
//     Route::get('/development-plan', [CompanyController::class, 'developmentPlan'])->name('company.development-plan');
//     Route::get('/meeting-minutes', [CompanyController::class, 'meetingMinutes'])->name('company.meeting-minutes');
//     Route::get('/requisites', [CompanyController::class, 'requisites'])->name('company.requisites');
//     Route::get('/vacancy', [CompanyController::class, 'vacancy'])->name('company.vacancy');
// });
Route::get('/company/{section?}', [CompanyController::class, 'index'])
    ->where('section', 'about|documents|plans|vacancy')
    ->name('company');
Route::get('/company/{any}', function () {
    return inertia('Company/Index', ['initialSection' => 'about']);
})->where('any', '.*');
Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
