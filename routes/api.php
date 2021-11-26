<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ReviewController;
use App\Http\Controllers\Api\BookableController;
use App\Http\Controllers\Api\CheckoutController;
use App\Http\Controllers\Api\BookablePriceController;
use App\Http\Controllers\Api\BookableReviewController;
use App\Http\Controllers\Api\BookingByReviewController;
use App\Http\Controllers\Api\BookableAvailabilityController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::apiResource('bookables', BookableController::class)->only(['index', 'show']);

Route::get('bookables/{bookable}/availability', BookableAvailabilityController::class)
    ->name('bookables.availability.show');

Route::get('bookables/{bookable}/reviews', BookableReviewController::class)
        ->name('bookables.reviews.show');

Route::get('bookables/{bookable}/price', BookablePriceController::class)
        ->name('bookables.price.show');

Route::get('/booking-by-review/{id}', BookingByReviewController::class)
        ->name('booking.by-review.show');

Route::apiResource('reviews', ReviewController::class)
        ->only(['show', 'store']);

Route::post('checkout', CheckoutController::class)
        ->name('checkout');