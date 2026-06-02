<?php
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.home');
})->name('home');

Route::get('/tutors', function () {
    return view('pages.tutors');
})->name('tutors');

Route::get('/tutors/{id}', function ($id) {
    // Pastikan tulisannya 'tutors-detail' sesuai nama file kamu
    return view('pages.tutors-detail', ['id' => $id]);
})->name('tutor.detail');

Route::get('/login', function () {
    return view('pages.login');
})->name('login');

Route::get('/signup', function () {
    return view('pages.signup');
})->name('signup');

Route::view('/chat', 'pages.chat')->name('chat');

Route::view('/voucher', 'pages.belivoucher')->name('belivoucher');

Route::view('/checkout', 'pages.checkout')->name('checkout');
