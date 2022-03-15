<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\EmailVerificationController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\ForgetPasswordController;
use Illuminate\Support\Facades\Route;

/** ************************ Auth
 * Registration with Email validation,
 * login,
 * Forgot password with Email link
****************************************/
Route::prefix('v1')->group( function () {
    Route::post('login', [AuthController::class, 'login'])->name('login');
    Route::post('registration', [AuthController::class, 'registration']);
});

// to get registration email
Route::get('verify-email/{id}/{hash}', [EmailVerificationController::class, 'verify'])
    ->middleware(['signed'])->name('verification.verify');

// for user to send verification email again, if timeout or misplaced
Route::post('email/verification-notification', [EmailVerificationController::class, 'sendVerificationEmail'])
    ->middleware(['throttle:6,1'])->name('verification.send');

// mail with token for forget password
Route::post('forgot-password', [ForgetPasswordController::class, 'forgotPassword'] )->middleware('guest');
Route::post('reset-password', [ForgetPasswordController::class, 'resetPassword'])->middleware('guest');

Route::middleware(['auth:api'])->prefix('v1')->group( function () {
    /**
     * Authentication related
     */
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::get('refresh-check', [AuthController::class, 'check']);
});

Route::middleware([ 'verified', 'auth:api'])->prefix('v1')->group( function () {
    Route::get('profile', [UserController::class, 'profile']);
});


