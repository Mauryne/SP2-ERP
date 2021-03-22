<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\InterventionController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\UserController;
use App\Http\Livewire\InterventionMap;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\DevicesMap;

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
    return view('auth/login');
})->name('default')->middleware('guest');

Auth::routes();

Route::get('/devices', [DeviceController::class, 'index'])->name('devices')->middleware('auth');
Route::get('/devices/{id}/show/map', DevicesMap::class)->name('devices.map')->middleware('auth');
Route::get('/devices/create', [DeviceController::class, 'create'])->name('devices.create')->middleware('auth');
Route::post('/devices/create/store', [DeviceController::class, 'store'])->name('devices.store')->middleware('auth');

Route::get('/interventions', [InterventionController::class, 'index'])->name('interventions')->middleware('auth');
Route::get('/interventions/{id}/show/map', InterventionMap::class)->name('interventions.map')->middleware('auth');
Route::get('/interventions/create', [InterventionController::class, 'create'])->name('interventions.create')->middleware('auth');
Route::post('/interventions/store', [InterventionController::class, 'store'])->name('interventions.store')->middleware('auth');

Route::get('/users', [UserController::class, 'index'])->name('users')->middleware('auth');
Route::get('/users/create', [UserController::class, 'create'])->name('users.create')->middleware('auth');
Route::post('/users/store', [UserController::class, 'store'])->name('users.store')->middleware('auth');

Route::get('/sales/map', [SalesController::class, 'index'])->name('sales.map')->middleware('auth');

Route::get('/customers', [CustomerController::class, 'index'])->name('customers')->middleware('auth');

Route::post('/logout', [App\Http\Controllers\HomeController::class, 'logout'])->name('logout')->middleware('auth');

