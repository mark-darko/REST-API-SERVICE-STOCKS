<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CityController;
use App\Http\Controllers\StockController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/get-token', [AuthController::class, 'getToken']);

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('cities', CityController::class);
    Route::apiResource('stocks', StockController::class);
    Route::get('city/{id}/stocks', [CityController::class, 'stocks']);
    Route::post('stock/nearby', [StockController::class, 'nearby']);
});
