<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('home/roles', \App\Http\Controllers\RoleController::class)->middleware('auth');
Route::resource('home/users', \App\Http\Controllers\UserController::class)->middleware('auth');

Route::resource('home/settings/institutions', \App\Http\Controllers\Settings\InstitutionController::class)
    ->names('settings.institutions')->middleware('auth');
Route::resource('home/settings/periods', \App\Http\Controllers\Settings\PeriodController::class)
    ->names('settings.periods')->middleware('auth');
Route::resource('home/settings', \App\Http\Controllers\SettingController::class)->middleware('auth');

Route::resource('home/levels', \App\Http\Controllers\LevelController::class)->middleware('auth');
