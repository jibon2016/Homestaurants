<?php

use App\Http\Controllers\Vendor\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Vendor\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Vendor\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Vendor\Auth\EmailVerificationPromptControllerForVendor;
use App\Http\Controllers\Vendor\Auth\NewPasswordController;
use App\Http\Controllers\Vendor\Auth\PasswordController;
use App\Http\Controllers\Vendor\Auth\PasswordResetLinkController;
use App\Http\Controllers\Vendor\Auth\RegisteredUserController;
use App\Http\Controllers\Vendor\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;

Route::middleware(['guest:vendor', 'restrict.vendor', 'restrict.admin', 'restrict.delm'])->prefix('vendor')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])
                ->name('vendor.register');

    Route::post('register', [RegisteredUserController::class, 'store'])->name('vendor.register.submit');

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
                ->name('vendor.login');

    Route::post('login', [AuthenticatedSessionController::class, 'store'])->name('vendor.login.submit');

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
                ->name('vendor.password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
                ->name('vendor.password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
                ->name('vendor.password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
                ->name('vendor.password.store');
});

Route::prefix('vendor')->middleware('auth:vendor')->group(function () {
    Route::get('verify-email', EmailVerificationPromptControllerForVendor::class)
                ->name('vendor.verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
                ->middleware(['signed', 'throttle:6,1'])
                ->name('vendor.verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
                ->middleware('throttle:6,1')
                ->name('vendor.verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
                ->name('vendor.password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('password', [PasswordController::class, 'update'])->name('vendor.password.update');

    Route::post('vendor/logout', [AuthenticatedSessionController::class, 'destroy'])
                ->name('vendor.logout');
});
