<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

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

/*index.blade.php*/
Route::get('/products',[ProductController::class, 'index'])->name('products.index') ;


/*detail.blade.php*/
Route::get('/products/detail/{productId}', [ProductController::class, 'detail'])
    ->name('products.detail');


Route::put('/products/detail/{productId}', [ProductController::class, 'update'])
    ->name('products.update');



Route::delete('/products/detail/{productId}', [ProductController::class, 'destroy'])
    ->name('products.destroy');


/*register.blade.php*/
Route::get('/products/register', [ProductController::class, 'register'])->name('products.register');


Route::post('/products/store', [ProductController::class, 'store'])->name('products.store');

