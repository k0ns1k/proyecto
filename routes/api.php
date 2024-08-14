<?php

use App\Http\Controllers\Api\AttemptController;
use App\Http\Controllers\Api\CustomersController;
use App\Http\Controllers\Api\CustomersDocumentsController;
use App\Http\Controllers\Api\RegisterController;
use App\Http\Controllers\Api\VerifyController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
Route::apiResource('/customers', CustomersController::class)
    ->middleware('auth:sanctum');

Route::apiResource('/customers/{customer}/documents', CustomersDocumentsController::class)
    ->middleware('auth:sanctum');
Route::get('/customers/{customer}/documents/{document}/download', [
    CustomersDocumentsController::class, 'download',
])->middleware('auth:sanctum');

Route::post('/register', RegisterController::class);
Route::post('/verify', VerifyController::class);
Route::post('/attempt', AttemptController::class);
