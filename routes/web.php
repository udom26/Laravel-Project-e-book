<?php
use Illuminate\Support\Facades\Route;

// Admin
Route::get('/dashboard', function () {
    return view('admin.dashboard');
})->name('dashboard');

// Auth
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::get('/resetpass', function () {
    return view('auth.resetpass');
})->name('resetpass');

// Ebook
Route::get('/', function () {
    return view('ebook.home');
});

Route::get('/bookdetail', function () {
    return view('ebook.bookdetail');
})->name('bookdetail');


Route::get('/transection', function () {
    return view('ebook.transection');
})->name('transection');


