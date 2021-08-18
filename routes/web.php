<?php

use App\Http\Controllers\Series\SeriesController;
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

Route::group([
    'prefix' => 'series'
], function () {
    Route::get('', [SeriesController::class, 'index'])->name('series.index');
    Route::get('criar', [SeriesController::class, 'create'])->name('series.create');
    Route::post('criar', [SeriesController::class, 'store'])->name('series.store');
    Route::get('edit/{serie}', [SeriesController::class, 'edit'])->name('series.edit');
    Route::put('edit/{serie}', [SeriesController::class, 'update'])->name('series.update');
    Route::delete('destroy/{serie}', [SeriesController::class, 'destroy'])->name('series.destroy');
});

