<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Users
Route::apiResource('users', UserController::class);
Route::patch('users/{user}/toggle-status', [UserController::class, 'toggleStatus'])->name('users.toggle-status');

// Services
Route::apiResource('services', ServiceController::class);
Route::patch('services/{service}/toggle-status', [ServiceController::class, 'toggleStatus'])->name('services.toggle-status');

// Categories
Route::apiResource('categories', CategoryController::class);

// Products
Route::apiResource('products', ProductController::class);
Route::patch('products/{product}/stock', [ProductController::class, 'updateStock'])->name('products.update-stock');

// Appointments
Route::apiResource('appointments', AppointmentController::class);
Route::patch('appointments/{appointment}/confirm', [AppointmentController::class, 'confirm'])->name('appointments.confirm');
Route::patch('appointments/{appointment}/complete', [AppointmentController::class, 'complete'])->name('appointments.complete');
Route::patch('appointments/{appointment}/cancel', [AppointmentController::class, 'cancel'])->name('appointments.cancel');
Route::patch('appointments/{appointment}/no-show', [AppointmentController::class, 'noShow'])->name('appointments.no-show');

// Orders
Route::apiResource('orders', OrderController::class);
Route::patch('orders/{order}/status', [OrderController::class, 'updateStatus'])->name('orders.update-status');
Route::patch('orders/{order}/payment-status', [OrderController::class, 'updatePaymentStatus'])->name('orders.update-payment-status');
Route::post('orders/{order}/cancel', [OrderController::class, 'cancel'])->name('orders.cancel');
