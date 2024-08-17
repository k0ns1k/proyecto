<?php

use App\Http\Controllers\Api\AttemptController;
use App\Http\Controllers\Api\ChangePasswordController;
use App\Http\Controllers\Api\CustomersController;
use App\Http\Controllers\Api\CustomersDocumentsController;
use App\Http\Controllers\Api\RecoveryController;
use App\Http\Controllers\Api\RegisterController;
use App\Http\Controllers\Api\VerifyController;
use Illuminate\Foundation\Http\Middleware\HandlePrecognitiveRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware([HandlePrecognitiveRequests::class, 'auth:sanctum']);

Route::apiResource('/customers', CustomersController::class)
    ->middleware([HandlePrecognitiveRequests::class, 'auth:sanctum']);


Route::apiResource('/customers/{customer}/documents', CustomersDocumentsController::class)
    ->middleware([HandlePrecognitiveRequests::class, 'auth:sanctum']);

Route::get('/customers/{customer}/documents/{document}/download', [
    CustomersDocumentsController::class, 'download',
])->middleware([HandlePrecognitiveRequests::class,'auth:sanctum']);


Route::post('/register', RegisterController::class)
    ->middleware([HandlePrecognitiveRequests::class]);

Route::post('/verify', VerifyController::class)
    ->middleware([HandlePrecognitiveRequests::class]);

Route::post('/attempt', AttemptController::class)
    ->middleware([HandlePrecognitiveRequests::class]);

Route::post('/recovery', RecoveryController::class)
    ->middleware([HandlePrecognitiveRequests::class]);

Route::post('/change-password', ChangePasswordController::class)
    ->middleware([HandlePrecognitiveRequests::class]);
