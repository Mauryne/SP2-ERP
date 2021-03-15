<?php

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

Route::get('/devices', [App\Http\Controllers\DeviceController::class, 'index'])->name('devices')->middleware('auth');
Route::get('/devices/{id}/show/map', DevicesMap::class)->name('devices.map')->middleware('auth');
Route::get('/devices/create', [App\Http\Controllers\DeviceController::class, 'create'])->name('devices.create')->middleware('auth');

Route::view('/devices/upload', 'devices-create');
Route::post('/devices/upload', [App\Http\Controllers\DeviceController::class, 'uploadFile'])->name('devices.upload')->middleware('auth');


Route::post('/devices/create/store', [App\Http\Controllers\DeviceController::class, 'store'])->name('devices.store')->middleware('auth');


Route::get('/customers', [App\Http\Controllers\CustomerController::class, 'index'])->name('customers')->middleware('auth');
Route::get('/interventions', [App\Http\Controllers\InterventionController::class, 'index'])->name('interventions')->middleware('auth');
Route::get('/map', [App\Http\Controllers\MapController::class, 'index'])->name('map')->middleware('auth');
Route::get('/users', [App\Http\Controllers\UserController::class, 'index'])->name('users')->middleware('auth');

Route::post('/logout', [App\Http\Controllers\HomeController::class, 'logout'])->name('logout')->middleware('auth');

