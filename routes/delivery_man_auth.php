<?php

use App\Http\Controllers\DeliveryMan\Auth\AuthenticatedSessionController;
use App\Http\Controllers\DeliveryMan\Auth\ConfirmablePasswordController;
use App\Http\Controllers\DeliveryMan\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\DeliveryMan\Auth\EmailVerificationPromptControllerForDeliveryMan;
use App\Http\Controllers\DeliveryMan\Auth\NewPasswordController;
use App\Http\Controllers\DeliveryMan\Auth\PasswordController;
use App\Http\Controllers\DeliveryMan\Auth\PasswordResetLinkController;
use App\Http\Controllers\DeliveryMan\Auth\RegisteredUserController;
use App\Http\Controllers\DeliveryMan\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;

Route::middleware(['guest', 'restrict.vendor', 'restrict.admin', 'restrict.delm'])->prefix('delivery-man')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])
                ->name('delm.register');

    Route::post('register', [RegisteredUserController::class, 'store'])->name('delm.register.submit');

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
                ->name('delm.login');

    Route::post('login', [AuthenticatedSessionController::class, 'store'])->name('delm.login.submit');

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
                ->name('delm.password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
                ->name('delm.password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
                ->name('delm.password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
                ->name('delm.password.store');
});

Route::prefix('delivery-man')->middleware('auth:delivery_man')->group(function () {
    Route::get('verify-email', EmailVerificationPromptControllerForDeliveryMan::class)
                ->name('delm.verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
                ->middleware(['signed', 'throttle:6,1'])
                ->name('delm.verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
                ->middleware('throttle:6,1')
                ->name('delm.verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
                ->name('delm.password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('password', [PasswordController::class, 'update'])->name('delm.password.update');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
                ->name('delm.logout');
});
