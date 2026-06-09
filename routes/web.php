<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookingController;

Route::get('/', fn() => view('pages.home'))->name('home');

Route::get('/tutors',          [BookingController::class, 'tutorList'])->name('tutors');
Route::get('/tutors/{id}',     [BookingController::class, 'tutorDetail'])->name('tutor.detail');
Route::get('/checkout',        [BookingController::class, 'checkout'])->name('checkout');
Route::post('/checkout',       [BookingController::class, 'confirmPayment'])->name('checkout.confirm');
Route::get('/payment',         [BookingController::class, 'paymentStatus'])->name('payment');

Route::get('/login',  fn() => view('pages.login'))->name('login');
Route::get('/signup', fn() => view('pages.signup'))->name('signup');
Route::get('/chat/{tutor_id?}', [\App\Http\Controllers\ChatController::class, 'index'])->name('chat');
Route::view('/voucher', 'pages.belivoucher')->name('belivoucher');
