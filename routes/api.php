<?php

use App\Http\Controllers\CakeController;
use App\Http\Controllers\CakeInterestListController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix' => 'cakes', 'as' => 'cakes.'], function () {
    Route::get('/email', [CakeController::class, 'mail'])->name('mail');


    Route::get('/', [CakeController::class, 'index'])->name('list');
    Route::post('/', [CakeController::class, 'store'])->name('store');
    Route::get('/{id}', [CakeController::class, 'show'])->name('show');
    Route::put('/{id}', [CakeController::class, 'update'])->name('update');
    Route::delete('/{id}', [CakeController::class, 'destroy'])->name('destroy');

    Route::group(['prefix' => '{cake_id}/interest-list', 'as' => 'interest-list.'], function () {
        Route::post('/', [CakeInterestListController::class, 'store'])->name('store');
    });
});

