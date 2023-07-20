<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InventarioController;
use App\Http\Controllers\ProductController;

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

Route::get('/',function(){
    return view('Menus.index');
})->name('productos');

Route::get('/Agregar',function(){
    return view('Menus.agregar');
})->name('invSave');

Route::get('/Stock',function(){
    return view('Menus.stock');
})->name('invStocks');






Route::post('/Stock', [InventarioController::class, 'store'])->name('save');

Route::get('/Stock/{id}', [InventarioController::class, 'show'])->name('show');

Route::patch('/Stock/{id}', [InventarioController::class, 'update'])->name('edit');

Route::delete('/Stock/{id}', [InventarioController::class, 'destroy'])->name('delete');

Route::get('/Stock', [InventarioController::class, 'search'])->name('search');


Route::post('/', [ProductController::class, 'addProduct'])->name('addProduct');

Route::get('/', [ProductController::class, 'showProducts'])->name('productos');

Route::get('//info', [ProductController::class, 'infoPago'])->name('infoPago');

Route::delete('/', [ProductController::class, 'removeStock'])->name('removeProduct');

Route::delete('//{id}', [ProductController::class, 'destroy'])->name('deleteProduct');



//Route::get('/test','EjemploController@index');

//php artisan serve lo inicia