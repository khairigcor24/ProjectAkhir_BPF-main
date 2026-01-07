<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DonasiController;
use App\Http\Controllers\GuestDonasiController;
use App\Models\Bansos;
/*
|--------------------------------------------------------------------------
| PUBLIC (BELUM LOGIN)
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    $semua_bansos = Bansos::where('status', 'aktif')->get();
    return view('welcome', compact('semua_bansos'));
});

Route::get('/donasi', [GuestDonasiController::class, 'index'])->name('donasi.public');
Route::get('/donasi/search', [GuestDonasiController::class, 'search'])->name('donasi.search');

/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

/*
|--------------------------------------------------------------------------
| DASHBOARD (SEMUA USER LOGIN)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::patch('/profile/password', [ProfileController::class, 'password'])->name('profile.password');
});

/*
|--------------------------------------------------------------------------
| USERS (ADMIN)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'admin'])->group(function () {
    Route::resource('user', UserController::class);
});

/*
|--------------------------------------------------------------------------
| DONASI - ADMIN ONLY
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('donasi/create', [DonasiController::class, 'create'])->name('donasi.create');
    Route::post('donasi', [DonasiController::class, 'store'])->name('donasi.store');
    Route::get('donasi/{donasi}/edit', [DonasiController::class, 'edit'])->name('donasi.edit');
    Route::put('donasi/{donasi}', [DonasiController::class, 'update'])->name('donasi.update');
    Route::delete('donasi/{donasi}', [DonasiController::class, 'destroy'])->name('donasi.destroy');
});

/*
|--------------------------------------------------------------------------
| DONASI - ADMIN & STAFF
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'adminOrStaff'])->group(function () {
    Route::get('donasi', [DonasiController::class, 'index'])->name('donasi.index');
    Route::get('donasi/laporan', [DonasiController::class, 'laporan'])->name('donasi.laporan');
    Route::get('donasi/{donasi}', [DonasiController::class, 'show'])->name('donasi.show');
    Route::post('donasi/{donasi}/validate', [DonasiController::class, 'validateDonasi'])->name('donasi.validate');
});
