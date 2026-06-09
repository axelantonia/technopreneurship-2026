<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookingController;

Route::get('/', fn() => view('pages.home'))->name('home');
Route::get('/home', fn() => redirect('/'));
// ── Tutor Panel (multi-page) ──────────────────────────────────────────
Route::get('/tutor/dashboard', fn() => view('tutors.dashboard'))->name('tutor.dashboard');
Route::get('/tutor/packages',  fn() => view('tutors.packages'))->name('tutor.packages');
Route::get('/tutor/schedule',  fn() => view('tutors.schedule'))->name('tutor.schedule');
Route::get('/tutor/financial', fn() => view('tutors.financial'))->name('tutor.financial');
Route::get('/tutor/chat',      fn() => view('tutors.chat'))->name('tutor.chat');

Route::get('/tutors',              [BookingController::class, 'tutorList'])->name('tutors');
Route::get('/tutors/dashboard',    fn() => view('tutors.dashboard'))->name('tutors.dashboard');
Route::get('/tutors/{id}',         [BookingController::class, 'tutorDetail'])->name('tutor.detail');
Route::get('/checkout',        [BookingController::class, 'checkout'])->name('checkout');
Route::post('/checkout',       [BookingController::class, 'confirmPayment'])->name('checkout.confirm');
Route::get('/payment',         [BookingController::class, 'paymentStatus'])->name('payment');

Route::get('/login',  fn() => view('pages.login'))->name('login');
Route::get('/signup', fn() => view('pages.signup'))->name('signup');
Route::get('/chat/{tutor_id?}', [\App\Http\Controllers\ChatController::class, 'index'])->name('chat');
Route::view('/voucher', 'pages.belivoucher')->name('belivoucher');


