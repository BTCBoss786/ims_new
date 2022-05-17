<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\InvoiceController;
use Illuminate\Support\Facades\Artisan;
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

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
Route::resource('customer', CustomerController::class);
Route::resource('inventory', InventoryController::class);
Route::resource('invoice', InvoiceController::class);

Route::get('/setup', function() {
   Artisan::call('optimize:clear');
   Artisan::call('migrate:fresh', ['--force' => true]);
   Artisan::call('db:seed', ['--force' => true]);
   return redirect()->route('dashboard');
});
Route::fallback(function() {
   return redirect()->route('dashboard');
});