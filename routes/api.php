<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PymeController;
use App\Http\Controllers\ServiceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Login and Register routes
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

Route::group(['middleware' => ['auth:sanctum']], function () {
    // Logout route
    Route::post('/logout', [AuthController::class, 'logout']);

    // Profile routes
    Route::get('/profile', [ProfileController::class, 'getProfile']);
    Route::put('/profile', [ProfileController::class, 'updateProfile']);

    Route::get('/pyme', [PymeController::class, 'getPyme']);
    Route::put('/pyme', [PymeController::class, 'updatePyme']);

    // Service routes
    Route::group(['prefix' => 'pyme'], function () {
        Route::get('/{pymeId}/service', [ServiceController::class, 'getByPyme']);
        Route::get('/{pymeId}/service/all', [ServiceController::class, 'getAllByPyme']);
        Route::get('/service/{serviceId}', [ServiceController::class, 'getById']);
        Route::post('/service', [ServiceController::class, 'create']);
        Route::put('/service/{serviceId}', [ServiceController::class, 'update']);
        Route::patch('/service/{serviceId}/status', [ServiceController::class, 'changeStatus']);
        Route::delete('/service/{serviceId}', [ServiceController::class, 'delete']);
    });
});