<?php

use App\Http\Controllers\Series\EpisodiosController;
use App\Http\Controllers\Series\SeriesController;
use App\Http\Controllers\Series\TemporadasController;
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

Route::get('/', function () {return redirect()->route('series.index');});

Route::group([
    'prefix' => 'series'
], function () {
    Route::get('', [SeriesController::class, 'index'])->name('series.index');
    Route::get('criar', [SeriesController::class, 'create'])->name('series.create');
    Route::post('criar', [SeriesController::class, 'store'])->name('series.store');
    Route::get('edit/{serie}', [SeriesController::class, 'edit'])->name('series.edit');
    Route::put('edit/{serie}', [SeriesController::class, 'update'])->name('series.update');
    Route::delete('destroy/{serie}', [SeriesController::class, 'destroy'])->name('series.destroy');
    Route::get('{serie}/temporadas', [TemporadasController::class, 'index'])->name('series.temporadas.index');
    Route::post('{serie}/updateName', [SeriesController::class, 'updateName'])->name('series.update.name');
    Route::get('temporadas/{temporada}/episodios', [EpisodiosController::class, 'index'])->name('series.temporadas.episodios.index');
    Route::post('temporadas/{temporada}/episodios/assistir', [EpisodiosController::class, 'watch'])->name('series.temporadas.episodios.watch');
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
