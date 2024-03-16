<?php

use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\DeliveryAreaController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\PaymentGatewaySettingController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProductGalleryController;
use App\Http\Controllers\Admin\ProductOptionController;
use App\Http\Controllers\Admin\ProductSizeController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\SettingController;
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

    // Product Category Routes
    Route::resource('category', CategoryController::class);

    // Product Routes
    Route::resource('product', ProductController::class);

    // Product Gallery Routes
    Route::get('product-gallery/{product}', [ProductGalleryController::class, 'index'])
        ->name('product-gallery.show-index');
    Route::resource('product-gallery', ProductGalleryController::class);

    // Product Size Routes
    Route::get('product-size/{product}', [ProductSizeController::class, 'index'])
        ->name('product-size.show-index');
    Route::resource('product-size', ProductSizeController::class);

    // Product Size Routes
    Route::resource('product-option', ProductOptionController::class);

    // Coupon Routes
    Route::resource('coupon', CouponController::class);

    // Delivery Area
    Route::resource('delivery-area', DeliveryAreaController::class);
    // Order Route
    Route::get('orders', [OrderController::class, 'index'])->name('order.index');

    // Payment Gateway Setting
    Route::get('/payment-gateway-setting', [PaymentGatewaySettingController::class, 'index'])
        ->name('payment-setting.index');
    Route::put('/payment-setting', [PaymentGatewaySettingController::class, 'paypalSettingUpdate'])
        ->name('payment-setting.update');

    // Setting Route
    Route::get('/setting', [SettingController::class, 'index'])->name('setting.index');
    Route::put('/general-setting', [SettingController::class, 'updateGeneralSetting'])->name('general-setting.update');
});
