<?php

use App\Http\Controllers\AgencyController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProductUnitController;
use App\Http\Controllers\ProductController;
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

Route::get('/', function () {
    return redirect('product-units');
});

Route::resource('product-units', ProductUnitController::class);
Route::get('products', [ProductController::class, 'index'])->name('products.index');

Route::resource('agencies', AgencyController::class)->except([
    'create', 'edit', 'show'
]);

Route::get('customers-table', [CustomerController::class, 'table'])->name('customers.table.index');
Route::get('customers-datatable', [CustomerController::class, 'datatable'])->name('customers.datatable.index');