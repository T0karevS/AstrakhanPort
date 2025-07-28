<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Http\Controllers\CompanyController; 
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\AdminController;


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
// Route::get('/admin/login', function () {
//     return Inertia::render('AdminAuth');
// })->name('login');

// // Проверка пароля и редирект в админку
// Route::post('/admin/login', function (Request $request) {
//     if ($request->password !== env('ADMIN_PASSWORD')) {
//         return back()->withErrors(['password' => 'Неверный пароль']);
//     }

//     // Редирект с паролем в URL (но скрыто, через временный токен)
//     return redirect()->route('admin.dashboard', [
//         'password' => $request->password
//     ]);
// });

// // Защищённые админ-роуты
// Route::prefix('admin')->middleware('admin.password')->group(function () {
//     Route::get('/', function () {
//         return Inertia::render('AdminPage');
//     })->name('admin.dashboard');

//     // ...остальные CRUD-роуты
// });
Route::middleware('admin')->group(function (){
    Route::get('/admin', fn() => Inertia::render('AdminPage'));
});
Route::match(['get', 'post'], '/admin', function( Request $request){
    if ($request->isMethod('post')){
        if ($request->password === env('ADMIN_PASSWORD')){
            $request->session()->put('is_admin', true);
        }
    }
    if(!$request->session()->get('is_admin')){
        return Inertia::render('AdminAuth');
    }
    return Inertia::render('AdminPage');
});
require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
