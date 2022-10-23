<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EventsController;
use App\Http\Controllers\UtensilController;
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

Route::redirect('/', '/dashboard');

Route::get('dashboard', [DashboardController::class, 'index'])
  ->name('dashboard')
  ->middleware('auth');

Route::get('utensils', [UtensilController::class, 'index'])
    ->name('utensils.index')
    ->middleware('auth');

Route::get('utensils/create', [UtensilController::class, 'create'])
    ->name('utensils.create')
    ->middleware('auth');

Route::get('utensils/edit/{utensil}', [UtensilController::class, 'edit'])
    ->name('utensils.edit')
    ->middleware('auth');

Route::post('utensils/{utensil}', [UtensilController::class, 'update'])
    ->name('utensils.update')
    ->middleware('auth');

Route::delete('utensils/{utensil}', [UtensilController::class, 'destroy'])
    ->name('utensils.destroy')
    ->middleware('auth');

Route::post('utensils', [UtensilController::class, 'store'])
    ->name('utensils.store')
    ->middleware('auth');

Route::get('utensils/{utensil}', [UtensilController::class, 'show'])
    ->name('utensils.show')
    ->middleware('auth');

Route::get('events', [EventsController::class, 'index'])
    ->name('events.index')
    ->middleware('auth');

Route::post('events/use', [EventsController::class, 'use'])
    ->name('events.use')
    ->middleware('auth');

Route::post('events/wash', [EventsController::class, 'wash'])
    ->name('events.wash')
    ->middleware('auth');
