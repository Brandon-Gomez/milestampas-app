<?php

use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\UploadController;
use App\Http\Controllers\Api\VariationController;
use App\Http\Controllers\Api\VariationOptionsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
Route::get('products', ProductController::class);
Route::get('variations', VariationController::class);
Route::get('variationOptions', VariationOptionsController::class);
Route::post('uploadProduct', [UploadController::class, 'uploadProduct']);
