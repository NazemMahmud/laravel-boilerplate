<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['api'])->prefix('v1')->group( function () {
    /**
     * Authentication related
     */
    Route::post('login', [AuthController::class, 'login']);
    Route::post('registration', [AuthController::class, 'registration']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::post('me', [AuthController::class, 'me']);
//    Route::post('sendPasswordResetLink', 'ResetPasswordController@sendEmail');
//    Route::post('resetPassword', 'ChangePasswordController@process');
});
