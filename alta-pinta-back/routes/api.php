<?php

use App\Http\Controllers\ImageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductTypeController;
use Illuminate\Http\Request;
use Illuminate\Routing\RouteGroup;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('product-types', ProductTypeController::class);
Route::apiResource('products', ProductController::class);
Route::controller(ImageController::class)->group(function () {
    Route::get('images', 'index')->name('images.index');
    Route::post('images', 'store')->name('images.store');
    Route::get('images/{image}', 'show')->name('images.show');
    Route::post('images/{image}', 'update')->name('images.update');
    Route::delete('images/{image}', 'destroy')->name('images.destroy');
});
