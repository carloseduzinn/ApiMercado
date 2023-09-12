<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MercadoController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/mercado', [MercadoController::class,'index']);
Route::get('/mercado/{id}', [MercadoController::class,'show']);
Route::post('/mercado', [MercadoController::class,'store']);
Route::delete('/mercado/{id}', [MercadoController::class,'destroy']);
Route::put('/mercado/{id}', [MercadoController::class, 'update']);