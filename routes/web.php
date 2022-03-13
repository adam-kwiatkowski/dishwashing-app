<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\UtensilController;
use App\Http\Controllers\DishwashingController;

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

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->name('dashboard');

Route::get('utensils', [UtensilController::class, 'index'])
    ->name('utensils')
    ->middleware('auth');

Route::post('utensils/use', [UtensilController::class, 'useUtensils'])
    ->middleware('auth');

Route::post('utensils/wash', [UtensilController::class, 'washUtensils'])
    ->middleware('auth');

Route::get('dishwashing', [DishwashingController::class, 'index'])
    ->name('dishwashing')
    ->middleware('auth');