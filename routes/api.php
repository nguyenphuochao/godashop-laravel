<?php

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

/**
 * test endpoint API
*/

Route::get('categories', function(Request $request) {
    return Category::paginate(5);
})->name('api.category.index');

Route::get('categories/{id}', function($id) {

    $category = Category::find($id);

    if(!$category) {
        return response()->json([
            'message' => 'Not Found'
        ], 404);
    }

    return $category;
})->name('api.category.show');

Route::post('categories', function(Request $request) {
    $validated = $request->validate([
        'name' => 'required',
    ]);

    $category = Category::create($validated);

    return $category;

})->name('api.category.store');

Route::put('categories/{id}', function(Request $request, $id) {
    $validated = $request->validate([
        'name' => 'required',
    ]);

    $category = Category::find($id);

    if(!$category) {
        return response()->json([
            'message' => 'Not Found'
        ], 404);
    }

    $category->update($validated);

    return response()->json([
        'message' => 'OK',
        'data' => $category
    ], 200);

})->name('api.category.update');

Route::delete('categories/{id}', function(Request $request, $id) {

    $category = Category::find($id);

    if(!$category) {
        return response()->json([
            'message' => 'Not Found'
        ], 404);
    }

    $category->forceDelete();

    return response()->noContent();

})->name('api.category.delete');
