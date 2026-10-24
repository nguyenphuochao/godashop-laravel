<?php

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\CategoryController;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

/**
 * test endpoint API
*/

Route::name('api.')->group(function() {
    Route::apiResource('categories', CategoryController::class);
});
