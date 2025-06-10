<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HanaController;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/hana/respond', [HanaController::class, 'respond']);
