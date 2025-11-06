<?php

use App\Http\Controllers\Home;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/english');
Route::get('/english', [Home::class, 'english']);
Route::get('/indonesia', [Home::class, 'indonesia']);

require __DIR__.'/films.php';
require __DIR__.'/reviews.php';
