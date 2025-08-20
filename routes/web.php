<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\RazorpayPaymentController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\App;

/*
 * |--------------------------------------------------------------------------
 * | Web Routes
 * |--------------------------------------------------------------------------
 * |
 * | Here is where you can register web routes for your application. These
 * | routes are loaded by the RouteServiceProvider and all of them will
 * | be assigned to the "web" middleware group. Make something great!
 * |
 */




Route::get('/lang/{locale}', function (string $locale) {
    if (! in_array($locale, ['en', 'ar'])) {
        abort(400);
    }
    App::setLocale($locale);
    Session::put('locale', $locale);
    return redirect()->back();
});


Route::get('/', [HomeController::class, 'index'])->name('home');

// About page
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/privacyPolicy', [PageController::class, 'privacy_policy'])->name('privacy_policy');
Route::get('/refund', [PageController::class, 'refund_policy'])->name('refund_policy');
Route::get('/term', [PageController::class, 'term'])->name('term');

// properties routes
Route::get('/properties', [PropertyController::class, 'index'])->name('properties.index');
Route::get('/properties/{property}', [PropertyController::class, 'show'])->name('properties.show');
Route::get('/properties/{property}/rooms', [PropertyController::class, 'rooms'])->name('properties.rooms');


// Rooms routes
Route::get('/rooms', [RoomController::class, 'index'])->name('rooms.index');
Route::get('/rooms/{id}', [RoomController::class, 'show'])->name('rooms.show');

// Booking routes
Route::get('/booking/search', [BookingController::class, 'search'])->name('booking.search');
Route::post('/booking/search', [BookingController::class, 'search'])->name('booking.search.post');
Route::match(['get', 'post'], '/booking/{booking_reference}/checkout', [BookingController::class, 'checkout'])->name('booking.checkout');
Route::post('/booking/store', [BookingController::class, 'store'])->name('booking.store');
Route::post('/booking/process', [BookingController::class, 'process'])->name('booking.process');
Route::get('/booking/confirmed', [BookingController::class, 'confirmation'])->name('booking.confirmation');
Route::get('/booking/download/{id}', [BookingController::class, 'download'])->name('booking.download');

//payment route
Route::get('razorpay-payment', [RazorpayPaymentController::class, 'index']);
Route::post('razorpay-payment', [RazorpayPaymentController::class, 'store'])->name('razorpay.payment.store');

// Contact routes
Route::get('/contacts', [ContactController::class, 'index'])->name('contacts.index');
Route::post('/contacts', [ContactController::class, 'store'])->name('contacts.store');
Route::get('/contacts/v2', [ContactController::class, 'v2'])->name('contacts.v2');

// Additional pages
Route::get('/gallery', [PageController::class, 'gallery'])->name('gallery');
Route::get('/faq', [PageController::class, 'faq'])->name('faq');
Route::get('/faq2', [PageController::class, 'faq2'])->name('faq2');
Route::get('/error', [PageController::class, 'error'])->name('error');
Route::get('/404', [PageController::class, 'notFound'])->name('404');
Route::get('/terms', [PageController::class, 'terms'])->name('terms');
Route::get('/privacy', [PageController::class, 'privacy'])->name('privacy');
