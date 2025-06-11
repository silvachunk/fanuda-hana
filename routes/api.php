<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HanaController;

// Fanuda AI route
Route::post('/hana/respond', [HanaController::class, 'respond']);
