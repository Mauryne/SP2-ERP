<?php

use App\Http\Controllers\ContractController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\EuropeanNormController;
use App\Http\Controllers\InterventionController;
use App\Http\Controllers\RenewalContractController;
use App\Http\Controllers\RenewalGuaranteeController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\StatisticController;
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
Route::get('/devices/{id}/edit', [DeviceController::class, 'edit'])->name('devices.edit')->middleware('auth');
Route::get('/devices/{id}/contract', [DeviceController::class, 'contract'])->name('devices.contract')->middleware('auth');
Route::post('/devices/contracts/store', [RenewalContractController::class, 'store'])->name('contracts.store')->middleware('auth');
Route::get('/devices/{id}/guarantee', [DeviceController::class, 'guarantee'])->name('devices.guarantee')->middleware('auth');
Route::post('/devices/guarantees/store', [RenewalGuaranteeController::class, 'store'])->name('guarantees.store')->middleware('auth');
Route::post('/devices/europeanNorm/picture/store', [EuropeanNormController::class, 'store'])->name('europeanNorm.store')->middleware('auth');
// Route::post('/interventions/{id}/update', [InterventionController::class, 'update'])->name('interventions.update')->middleware('auth');


Route::get('/interventions', [InterventionController::class, 'index'])->name('interventions')->middleware('auth');
Route::get('/interventions/{id}/show/map', InterventionMap::class)->name('interventions.map')->middleware('auth');
Route::get('/interventions/create', [InterventionController::class, 'create'])->name('interventions.create')->middleware('auth');
Route::post('/interventions/store', [InterventionController::class, 'store'])->name('interventions.store')->middleware('auth');
Route::get('/interventions/{id}/edit', [InterventionController::class, 'edit'])->name('interventions.edit')->middleware('auth');
Route::post('/interventions/{id}/update', [InterventionController::class, 'update'])->name('interventions.update')->middleware('auth');

Route::get('/users', [UserController::class, 'index'])->name('users')->middleware('auth');
Route::get('/users/create', [UserController::class, 'create'])->name('users.create')->middleware('auth');
Route::post('/users/store', [UserController::class, 'store'])->name('users.store')->middleware('auth');
Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit')->middleware('auth');
Route::post('/users/{id}/password/edit', [UserController::class, 'editPassword'])->name('users.password.edit')->middleware('auth');
Route::post('/users/{id}/update', [UserController::class, 'update'])->name('users.update')->middleware('auth');
Route::post('/users/{id}/password/update', [UserController::class, 'updatePassword'])->name('users.password.update')->middleware('auth');

Route::get('/customers', [CustomerController::class, 'index'])->name('customers')->middleware('auth');
Route::get('/customers/create', [CustomerController::class, 'create'])->name('customers.create')->middleware('auth');
Route::post('/customers/store', [CustomerController::class, 'store'])->name('customers.store')->middleware('auth');
Route::get('/customers/{id}/edit', [CustomerController::class, 'edit'])->name('customers.edit')->middleware('auth');
Route::post('/customers/{id}/update', [CustomerController::class, 'update'])->name('customers.update')->middleware('auth');

Route::get('/sales/map', [SaleController::class, 'index'])->name('sales.map')->middleware('auth');

Route::get('/statistics', [StatisticController::class, 'index'])->name('statistics')->middleware('auth');

Route::post('/logout', [App\Http\Controllers\HomeController::class, 'logout'])->name('logout')->middleware('auth');

