<?php

use App\Http\Controllers\Reviews;
use Illuminate\Support\Facades\Route;

Route::prefix('/reviews')->group(function () {
    Route::get('/', [Reviews::class, 'reviews']);
    Route::get('/top-reviewed', [Reviews::class, 'topReviewed']);
    Route::get('/5-stars', [Reviews::class, 'fiveStars']);
    Route::get('/4-stars', [Reviews::class, 'fourStars']);
    Route::get('/3-stars', [Reviews::class, 'threeStars']);
});
