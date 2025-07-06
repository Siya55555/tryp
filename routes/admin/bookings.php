<?php

use App\Http\Controllers\Admin\BookingController;

/*
|--------------------------------------------------------------------------
| Admin Booking Routes
|--------------------------------------------------------------------------
|
| This file contains all routes related to booking management in the admin panel
|
*/

// Main bookings index with type filtering
Route::get('/bookings', [BookingController::class, 'index'])->name('bookings.index');

// Bundle booking specific routes
Route::get('/bookings/bundles/create', [BookingController::class, 'create'])->name('bookings.bundles.create');
Route::get('/bookings/bundles/{booking}/edit', [BookingController::class, 'edit'])->name('bookings.bundles.edit');
Route::get('/bookings/bundles/{booking}', [BookingController::class, 'show'])->name('bookings.bundles.show');

// Package booking specific routes
Route::get('/bookings/packages/create', [BookingController::class, 'create'])->name('bookings.packages.create');
Route::get('/bookings/packages/{booking}/edit', [BookingController::class, 'edit'])->name('bookings.packages.edit');
Route::get('/bookings/packages/{booking}', [BookingController::class, 'show'])->name('bookings.packages.show');

// Generic booking routes (with type parameter)
Route::get('/bookings/create', [BookingController::class, 'create'])->name('bookings.create');
Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');
Route::get('/bookings/{booking}/edit', [BookingController::class, 'edit'])->name('bookings.edit');
Route::put('/bookings/{booking}', [BookingController::class, 'update'])->name('bookings.update');
Route::get('/bookings/{booking}', [BookingController::class, 'show'])->name('bookings.show');
Route::delete('/bookings/{booking}', [BookingController::class, 'destroy'])->name('bookings.destroy');

// Booking actions
Route::post('/bookings/{booking}/confirm', [BookingController::class, 'confirm'])->name('bookings.confirm');
Route::post('/bookings/{booking}/cancel', [BookingController::class, 'cancel'])->name('bookings.cancel');
Route::get('/bookings/{booking}/email', [BookingController::class, 'email'])->name('bookings.email');
Route::get('/bookings/{booking}/invoice', [BookingController::class, 'generateInvoice'])->name('bookings.invoice');