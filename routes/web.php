<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InventarioController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;

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
/*
Route::get('/', function () {
    return view('welcome');
});*/



Route::get('/Agregar', function () {
    return view('Menus.agregar');
})->name('invSave');

Route::get('/Stock', function () {
    return view('Menus.stock');
})->name('invStocks');


Route::get('/', [CartController::class, 'index'])->name('Menu');

Route::post('/', [CartController::class, 'addToCart'])->name('addCart');

Route::delete('/', [CartController::class, 'closeCart'])->name('closeCart');

Route::get('/Home/remove/{id}', [CartController::class, 'removeFromCart'])->name('removeCart');



Route::post('/Stock', [InventarioController::class, 'store'])->name('save');

Route::get('/Stock/{id}', [InventarioController::class, 'show'])->name('show');

Route::patch('/Stock/{id}', [InventarioController::class, 'update'])->name('edit');

Route::delete('/Stock/{id}', [InventarioController::class, 'destroy'])->name('delete');

Route::get('/Stock', [InventarioController::class, 'search'])->name('search');

Route::post('/Stock/temp', [InventarioController::class, 'addToCart'])->name('saveToCart');



//Route::get('/test','EjemploController@index');

//php artisan serve lo inicia
