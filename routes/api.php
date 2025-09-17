<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PymeController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ScheduleController;
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

    Route::group(['prefix' => 'pyme'], function () {
        // Service routes
        Route::get('/{pymeId}/service', [ServiceController::class, 'getByPyme']);
        Route::get('/{pymeId}/service/all', [ServiceController::class, 'getAllByPyme']);
        Route::get('/service/{serviceId}', [ServiceController::class, 'getById']);
        Route::post('/service', [ServiceController::class, 'create']);
        Route::put('/service/{serviceId}', [ServiceController::class, 'update']);
        Route::patch('/service/{serviceId}/status', [ServiceController::class, 'changeStatus']);
        Route::delete('/service/{serviceId}', [ServiceController::class, 'delete']);

        // Schedule routes
        Route::get('/{pymeId}/schedule/{startDate}/{endDate}', [ScheduleController::class, 'getByPymeAndDates']);
        Route::post('/{pymeId}/schedule', [ScheduleController::class, 'createRotativeSchedule']);
        Route::put('/{pymeId}/schedule', [ScheduleController::class, 'updateDateSchedule']);
        Route::delete('/{pymeId}/schedule/{startDate}/{endDate}', [ScheduleController::class, 'deleteByPymeAndDates']);
    });

    Route::group(['prefix' => 'reservation'], function () {
        Route::get('/pyme/{pymeId}/{startDate}/{endDate}', [ReservationController::class, 'getByPyme']);
        Route::get('/client/{startDate}/{endDate}', [ReservationController::class, 'getByClient']);
        Route::post('/', [ReservationController::class, 'create']);
    });

    Route::put('/payment', [PaymentController::class, 'updateStatus']);
});