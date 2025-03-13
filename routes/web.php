<?php

use App\Http\Controllers\UrlController;
use Illuminate\Support\Facades\Route;

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

// Main Routes
Route::get('/', [UrlController::class, 'index'])->name('home');
Route::get('/dashboard', [UrlController::class, 'dashboard'])->name('dashboard');

// URL Management Routes
Route::post('/urls', [UrlController::class, 'store'])->name('urls.store');
Route::get('/urls/{id}/details', [UrlController::class, 'getUrlDetails'])->name('urls.details');
Route::delete('/urls/{id}', [UrlController::class, 'delete'])->name('urls.delete');
Route::get('/dashboard/stats', [UrlController::class, 'getDashboardStats'])->name('dashboard.stats');

// Redirection Route - should be the last route as it catches all slugs
Route::get('/{slug}', [UrlController::class, 'redirect'])->name('redirect');
