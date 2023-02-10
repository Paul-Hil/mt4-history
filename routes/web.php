<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\HistoricController;

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
Route::get('/', MainController::class)->name('index');

Route::get('/trades-by-days/{month}/{year}', [MainController::class, 'tradesByDays'], function($month, $year) {
    return $month;
})->name('tradesByDays');

Route::get('/updateFileMT4', [MainController::class, 'updateFileMT4'])->name('updateFileMT4');

Route::prefix('/history')->group(function () {
    Route::controller(HistoricController::class)->group(function () {
        Route::get('/', 'index')->name('historic');
        Route::get('/add', 'add')->name('historic.add');
        Route::post('/add', 'add')->name('historic.add.post');

    });
});

