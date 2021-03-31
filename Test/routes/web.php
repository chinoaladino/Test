<?php

use App\Http\Controllers\PerritoController;
use App\Http\Controllers\RazaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;


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


Route::get('/', HomeController::class);

//Perrito routes
Route::get('/perritos', [PerritoController::class, 'index'])->name('perritos.index');
Route::get('/perritos/create',[PerritoController::class, 'create'])->name('perritos.create');
Route::get('/perritos/{perrito}',[PerritoController::class,'show'])->name('perritos.show');
Route::post('/perrito',[PerritoController::class,'store'])->name('perritos.store');
Route::delete('perritos/{id}',[PerritoController::class,'destroy'])->name('perritos.delete');
Route::get('/perritos/{perritos}/edit',[PerritoController::class,'edit'])->name('perritos.edit');
Route::post('/perritos/update/{id}',[PerritoController::class,'update'] )->name('perritos.update');

//Razas routes
Route::get('/razas', [RazaController::class, 'index'])->name('razas.index');
Route::get('/razas/create',[RazaController::class, 'create'])->name('razas.crate');
Route::get('/razas/{razas}',[RazaController::class,'show'])->name('razas.show');
Route::post('/razas',[RazaController::class,'store'])->name('razas.store');
Route::get('/razas/{razas}/edit',[RazaController::class,'edit'])->name('razas.edit');
Route::post('/razas/update/{id}',[RazaController::class,'update'])->name('razas.update');
Route::delete('razas/{id}',[RazaController::class,'destroy'])->name('razas.delete');