<?php

use App\Http\Controllers\Films;
use Illuminate\Support\Facades\Route;

Route::prefix('/films')->group(function () {
    Route::get('/', [Films::class, 'films']);
    Route::get('/movies', [Films::class, 'movies']);
    Route::get('/serial', [Films::class, 'series']);
    Route::get('/movies/{pick}', [Films::class, 'filter_movies']);
    Route::get('/serial/{pick}', [Films::class, 'filter_serial']);
    Route::get('/{pick}', [Films::class, 'genre']);
});

