<?php

use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\DailyOfferController;
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
    Route::get('orders/{id}', [OrderController::class, 'show'])->name('order.show');
    Route::delete('orders/{id}', [OrderController::class, 'destroy'])->name('order.destroy');

    Route::get('pending-orders', [OrderController::class, 'pendingOrdersIndex'])->name('pending-order');
    Route::get('inprocess-orders', [OrderController::class, 'inProcessOrdersIndex'])->name('inprocess-order');
    Route::get('delivered-orders', [OrderController::class, 'deliveredOrdersIndex'])->name('delivered-order');
    Route::get('declined-orders', [OrderController::class, 'declinedOrdersIndex'])->name('declined-order');

    Route::get('orders/status/{id}', [OrderController::class, 'getOrderStatus'])->name('orders.status');
    Route::put('orders/status-update/{id}', [OrderController::class, 'orderStatusUpdate'])->name('orders.status-update');

    // Order Notification
    Route::get('clear-notification', [AdminDashboardController::class, 'clearNotification'])->name('clear-notification');

    // Daily Offer Route
    Route::get('daily-offer/search-product', [DailyOfferController::class, 'productSearch'])->name('daily-offer.search-product');
    Route::put('daily-offer-title-update', [DailyOfferController::class, 'updateTitle'])
        ->name('daily-offer-title.update');
    Route::resource('daily-offer', DailyOfferController::class);

    // Payment Gateway Setting
    Route::get('/payment-gateway-setting', [PaymentGatewaySettingController::class, 'index'])
        ->name('payment-setting.index');
    Route::put('/payment-setting', [PaymentGatewaySettingController::class, 'paypalSettingUpdate'])
        ->name('payment-setting.update');

    // Setting Route
    Route::get('/setting', [SettingController::class, 'index'])->name('setting.index');
    Route::put('/general-setting', [SettingController::class, 'updateGeneralSetting'])->name('general-setting.update');
    Route::put('/pusher-setting', [SettingController::class, 'updatePusherSetting'])->name('pusher-setting.update');
});
