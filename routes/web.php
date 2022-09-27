<?php

use App\Http\Controllers\Category\CreateController;
use App\Http\Controllers\Category\DeleteController;
use App\Http\Controllers\Category\EditController;
use App\Http\Controllers\Category\IndexController;
use App\Http\Controllers\Category\StoreController;
use App\Http\Controllers\Category\UpdateController;
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


/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/', \App\Http\Controllers\Main\IndexController::class)->name('main.index');

Route::group(['prefix' => 'categories'], function() {
    Route::get('/', IndexController::class)->name('category.index');
    Route::get('/create', CreateController::class)->name('category.create');
    Route::get('/{category}/edit', EditController::class)->name('category.edit');
    Route::post('/', StoreController::class)->name('category.store');
    Route::patch('/{category}', UpdateController::class)->name('category.update');
    Route::delete('/{category}', DeleteController::class)->name('category.delete');
});

