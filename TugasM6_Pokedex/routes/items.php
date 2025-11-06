<?php

use App\Http\Controllers\ItemController;
use Illuminate\Support\Facades\Route;

Route::prefix('/items')
    ->name('items.')
    ->controller(ItemController::class)
    ->group(function () {
        Route::get('/detail/{id}', 'show')->name('show');
        Route::get('/{type?}', 'index')->name('index');
});
