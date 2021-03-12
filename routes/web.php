<?php

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/devices', [App\Http\Controllers\DeviceController::class, 'index'])->name('devices');
Route::get('/customers', [App\Http\Controllers\CustomerController::class, 'index'])->name('customers');
Route::get('/interventions', [App\Http\Controllers\InterventionController::class, 'index'])->name('interventions');
Route::get('/map', [App\Http\Controllers\MapController::class, 'index'])->name('map');
Route::get('/users', [App\Http\Controllers\UserController::class, 'index'])->name('users');

Route::post('/logout', [App\Http\Controllers\HomeController::class, 'logout'])->name('logout');
