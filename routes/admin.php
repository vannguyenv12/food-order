<?php

use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\WhyChooseUsController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('dashboard', [AdminDashboardController::class, 'index'])
        ->name('dashboard');

    // Profile Route
    Route::get('profile', [ProfileController::class, 'index'])
        ->name('profile');
    Route::put('profile', [ProfileController::class, 'updateProfile'])
        ->name('profile.update');

    Route::put('profile/password', [ProfileController::class, 'updatePassword'])
        ->name('profile.password.update');

    // Slider Route
    Route::resource('slider', SliderController::class);

    // Why Choose Us Route
    Route::put('why-choose-title-update', [WhyChooseUsController::class, 'updateTitle'])
        ->name('why-choose-title.update');
    Route::resource('why-choose-us', WhyChooseUsController::class);
});
