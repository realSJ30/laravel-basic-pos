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

// MENU CONTROLLER
Route::get('/', [App\Http\Controllers\MenusController::class, 'index']);
Route::get('/menu/create', [App\Http\Controllers\MenusController::class, 'create']);
Route::post('/m', [App\Http\Controllers\MenusController::class, 'store']);
Route::get('/menu/{MenuID}/edit', [App\Http\Controllers\MenusController::class, 'edit'])->name('menu.edit'); //shows the form of edit
Route::patch('/menu/{MenuID}', [App\Http\Controllers\MenusController::class, 'update'])->name('menu.update');   //do the process of edit
Route::delete('/menu/{MenuID}', [App\Http\Controllers\MenusController::class, 'destroy'])->name('menu.destroy');   //do the process of edit


// CATEGORY CONTROLLER
Route::get('/category/show', [App\Http\Controllers\CategoriesController::class, 'index']);
Route::get('/category/create', [App\Http\Controllers\CategoriesController::class, 'create']);
Route::get('/{categoryID}/edit', [App\Http\Controllers\CategoriesController::class, 'edit'])->name('category.edit'); //shows the form of edit
Route::post('/c', [App\Http\Controllers\CategoriesController::class, 'store']);
Route::patch('/category/{CategoryID}', [App\Http\Controllers\CategoriesController::class, 'update'])->name('category.update');   //do the process of edit
Route::delete('/category/{CategoryID}', [App\Http\Controllers\CategoriesController::class, 'destroy'])->name('category.destroy');   //do the process of edit
