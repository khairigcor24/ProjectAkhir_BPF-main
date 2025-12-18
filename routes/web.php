<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PageController;

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/home', function () {
    return view('home');
})->middleware(['auth', 'verified'])->name('home');


Route::get('/users', [UserController::class, 'index'])->name('user.index');

Route::get('/profile', function () {
    return view('profile.edit');
})->name('profile.edit');

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::get('/page/{page}', [PageController::class, 'index'])->name('page.index');

Route::resource('user', HomeController::class);
Route::get('/login', [HomeController::class, 'index'])->name('login');

