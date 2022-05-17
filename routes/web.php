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

Route::get('/', \App\Http\Livewire\DashboardLivewire::class)->name('dashboard');
Route::get('/customers', \App\Http\Livewire\CustomerLivewire::class)->name('customers');
Route::get('/inventories', \App\Http\Livewire\InventoryLivewire::class)->name('inventories');
Route::get('/invoices', \App\Http\Livewire\InvoiceLivewire::class)->name('invoices');
Route::fallback(\App\Http\Livewire\DashboardLivewire::class);
