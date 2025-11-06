<?php

use Illuminate\Support\Facades\Route;

Route::redirect('/', '/pokemon');

require __DIR__.'/pokemon.php';
require __DIR__.'/items.php';

