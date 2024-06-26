<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SizeController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductTypeController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\SelectController;
use App\Http\Controllers\UserController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
  return $request->user();
});

Route::post('createUser', [UserController::class, 'createUser'])->name('user.createUser');
Route::post('login', [UserController::class, 'login'])->name('user.login');

Route::apiResource('product-types', ProductTypeController::class);
Route::apiResource('products', ProductController::class);
Route::controller(ImageController::class)->group(function () {
  Route::get('images', 'index')->name('images.index');
  Route::post('images', 'store')->name('images.store');
  Route::get('images/{image}', 'show')->name('images.show');
  Route::post('images/{image}', 'update')->name('images.update');
  Route::delete('images/{image}', 'destroy')->name('images.destroy');
});
Route::apiResource('sizes', SizeController::class);
Route::apiResource('purchases', PurchaseController::class);

Route::controller(SelectController::class)->group(function () {
  Route::get('sltProductTypes', 'selectProductTypes')->name('select.sltProductTypes');
  Route::get('sltSizes', 'selectSizes')->name('select.sltSizes');
});
