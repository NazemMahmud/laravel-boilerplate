<?php

use App\Http\Controllers\EmailVerificationController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;


Route::prefix('v1')->group( function () {
    Route::post('login', [AuthController::class, 'login'])->name('login');
    Route::post('registration', [AuthController::class, 'registration']);
});

// to get registration email
Route::get('verify-email/{id}/{hash}', [EmailVerificationController::class, 'verify'])
    ->middleware(['auth', 'signed'])->name('verification.verify');

// for user to send verification email again, if timeout or misplaced
Route::post('email/verification-notification', [EmailVerificationController::class, 'sendVerificationEmail'])
    ->middleware(['auth:api', 'throttle:6,1'])->name('verification.send');

//Route::post('/email/verification-notification', function (Request $request) {
//    $request->user()->sendEmailVerificationNotification();
//
//    return back()->with('message', 'Verification link sent!');
//})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::middleware(['auth:api'])->prefix('v1')->group( function () {
    /**
     * Authentication related
     */

    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::get('refresh-check', [AuthController::class, 'check']);
    Route::get('profile', [UserController::class, 'profile']);
//    Route::post('sendPasswordResetLink', 'ResetPasswordController@sendEmail');
//    Route::post('resetPassword', 'ChangePasswordController@process');
});

Route::middleware([ 'verified', 'auth:api'])->prefix('v1')->group( function () {
    Route::get('profile', [UserController::class, 'profile']);
//    Route::post('sendPasswordResetLink', 'ResetPasswordController@sendEmail');
//    Route::post('resetPassword', 'ChangePasswordController@process');
});


