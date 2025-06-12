<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HanaController;

Route::post('/hana/respond', [HanaController::class, 'respond']);
