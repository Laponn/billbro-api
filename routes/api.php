<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TagihanController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/tagihan', [TagihanController::class, 'index']);
Route::post('/tagihan', [TagihanController::class, 'store']);
Route::put('/tagihan/soft-delete/{id}', [TagihanController::class, 'softDelete']);
Route::put('/tagihan/{id}', [TagihanController::class, 'update']);
