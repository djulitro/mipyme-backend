<?php

use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/verify-email', [AuthController::class, 'verifyEmail']);