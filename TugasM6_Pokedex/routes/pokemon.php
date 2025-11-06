<?php

use App\Http\Controllers\PokemonController;
use Illuminate\Support\Facades\Route;

Route::prefix('/pokemon')
    ->name('pokemon.')
    ->controller(PokemonController::class)
    ->group(function () {
        Route::get('/detail/{id}', 'show')->name('show');
        Route::get('/{type?}', 'index')->name('index');
});
