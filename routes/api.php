<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HanaController;

Route::get('/test', function () {
    return response()->json(['message' => 'API file is working!']);
});

Route::post('/hana/respond', [HanaController::class, 'respond']);
