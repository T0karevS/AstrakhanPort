<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Http\Controllers\CompanyController; 
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\DocumentController;
use App\Http\Controllers\Admin\VacancyController;
use App\Http\Controllers\Admin\AdminNewsController;
use App\Http\Controllers\LeadController;


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
Route::get('/news', [NewsController::class, 'index'])->name('news');
Route::get('/news/{id}', [NewsController::class, 'show'])->name('news.show');
Route::get('/tariffs', function () {
    return Inertia::render('Tariffs');
})->name('tariffs');
Route::get('/company', function () {
    return Inertia::render('Company');
})->name('company');
Route::get('/privacy_policy', function () {
    return Inertia::render('LicensesDetails');
})->name('company');
Route::get('/company/{section?}', [CompanyController::class, 'index'])
    ->where('section', 'about|documents|plans|vacancy|requisites')
    ->name('company');
Route::get('/company/{any}', function () {
    return inertia('Company/Index', ['initialSection' => 'about']);
})->where('any', '.*');
Route::get('/services/{section?}', [ServiceController::class, 'index'])
    ->where('section', 'export|import|termoobrabotka|morskie-gruzoperevozki|tamozhnya|teo|khranenie|zh-d-gruzoperevozki')
    ->name('ServicePage');
Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/admin/login', function () {
    return Inertia::render('AdminAuth');
})->name('admin.login');

Route::post('/admin/login', function (Request $request) {
    if ($request->password === env('ADMIN_PASSWORD')) {
        $request->session()->put('is_admin', true);
        return redirect()->route('admin.dashboard');
    }

    return back()->withErrors(['password' => 'Неверный пароль']);
})->name('admin.login.post');
Route::middleware('admin')->prefix('admin')->name('admin.')->group(function () {

    // Главная SPA-страница админки
    Route::get('/', [AdminController::class, 'index'])->name('dashboard');

    // Документы
    Route::resource('documents', DocumentController::class)->except('show')->names([
        'index' => 'documents.index',
        'store' => 'documents.store',
        'update' => 'documents.update',
        'destroy' => 'documents.destroy',
    ]);

    // Вакансии
    Route::resource('vacancies', VacancyController::class)->except('show')->names([
        'index' => 'vacancies.index',
        'store' => 'vacancies.store',
        'update' => 'vacancies.update',
        'destroy' => 'vacancies.destroy',
    ]);

    // Новости
    Route::resource('news', AdminNewsController::class)->except('show')->names([
        'index' => 'news.index',
        'store' => 'news.store',
        'destroy' => 'news.destroy',
    ]);
});

Route::post('/contact', [LeadController::class, 'store'])->name('contact.store');

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
