<?php

use App\Http\Controllers\Admin\ArticlesController;
use App\Http\Controllers\Admin\CommandesController;
use App\Http\Controllers\Admin\FournisseursController;

use App\Http\Controllers\Technicien\TechniciensController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\InterventionController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\DashboardController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('articles', ArticlesController::class)->except("update");
    Route::post('/articles/{id}',[ArticlesController::class, 'update'])->name('articles.update');
    Route::resource('commandes', CommandesController::class);
    Route::resource('fournisseurs', FournisseursController::class);
    Route::resource('techniciens', TechniciensController::class);
    Route::resource('clients', ClientController::class);
    Route::resource('interventions', InterventionController::class);
    Route::resource('sites', SiteController::class);
    Route::post('/document', [DocumentController::class, 'store'])->name('document.store');
    Route::delete('/document/{document}', [DocumentController::class, 'destroy'])->name('document.destroy');
    Route::get('/document/{document}', [DocumentController::class, 'download'])->name('document.download');
    Route::get('/calendar', 'App\Http\Controllers\CalendarController@__invoke')->name('calendar');
    Route::get('/interventionstojson', [InterventionController::class, 'interventionstojson'])->name('interventions.json');
    Route::get('/articlestojson', [ArticlesController::class, 'articlestojson'])->name('articles.json');
    Route::post('/storearticle', [ArticlesController::class, 'storearticle']);
    Route::get('/report/{id}',[ArticlesController::class,'report'])->name('report');


});
