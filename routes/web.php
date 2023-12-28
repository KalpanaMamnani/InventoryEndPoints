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

// routes/web.php

use App\Http\Controllers\GroceryItemController;

Route::get('/grocery-items', [GroceryItemController::class, 'index'])->name('grocery-items.index');
Route::get('/grocery-items/create', [GroceryItemController::class, 'create'])->name('grocery-items.create');
Route::post('/grocery-items', [GroceryItemController::class, 'store']);
Route::view('/grocery-items/discount-form', 'grocery-items.discount-form')->name('discount-form');
Route::post('/apply-discount', [GroceryItemController::class, 'applyDiscount'])->name('apply-discount');

