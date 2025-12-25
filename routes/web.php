<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PageController;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;

Route::get('/', function () {
    return view('welcome');
});
 
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/home', function () {
    return view('home');
})->middleware(['auth', 'verified'])->name('home');


Route::get('/users', [UserController::class, 'index'])->name('user.index');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::patch('/profile/password', [ProfileController::class, 'password'])->name('profile.password');
});

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::get('/page/{page}', [PageController::class, 'index'])->name('page.index');

Route::resource('user', UserController::class);

Route::get('/login', [App\Http\Controllers\LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [App\Http\Controllers\LoginController::class, 'login']);
Route::post('/logout', [App\Http\Controllers\LoginController::class, 'logout'])->name('logout');
Route::get('/forgot-password', function () { return 'Forgot Password'; })->name('password.request');

// ============================================
// GUEST ROUTES (Public - No Auth Required)
// ============================================
Route::prefix('guest')->name('guest.')->group(function () {
    Route::get('/donasi/search', [App\Http\Controllers\GuestDonasiController::class, 'search'])->name('donasi.search');
    Route::get('/donasi/create', [App\Http\Controllers\GuestDonasiController::class, 'create'])->name('donasi.create');
    Route::post('/donasi', [App\Http\Controllers\GuestDonasiController::class, 'store'])->name('donasi.store');
});

// ============================================
// ADMIN OR STAFF ROUTES (Both can access)
// ============================================
Route::middleware(['auth', 'adminOrStaff'])->group(function () {
    // Index - Admin melihat Table, Staff melihat Card/List (dihandle di controller)
    Route::get('donasi', [App\Http\Controllers\DonasiController::class, 'index'])->name('donasi.index');
    
    // Show detail
    Route::get('donasi/{donasi}', [App\Http\Controllers\DonasiController::class, 'show'])->name('donasi.show');
    
    // Validasi donasi (Admin dan Staff)
    Route::post('donasi/{donasi}/validate', [App\Http\Controllers\DonasiController::class, 'validateDonasi'])->name('donasi.validate');
    
    // Laporan (Admin dan Staff)
    Route::get('donasi/laporan', [App\Http\Controllers\DonasiController::class, 'laporan'])->name('donasi.laporan');
});

// ============================================
// ADMIN ONLY CRUD ROUTES
// ============================================
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('donasi/create', [App\Http\Controllers\DonasiController::class, 'create'])->name('donasi.create');
    Route::post('donasi', [App\Http\Controllers\DonasiController::class, 'store'])->name('donasi.store');
    Route::get('donasi/{donasi}/edit', [App\Http\Controllers\DonasiController::class, 'edit'])->name('donasi.edit');
    Route::put('donasi/{donasi}', [App\Http\Controllers\DonasiController::class, 'update'])->name('donasi.update');
    Route::delete('donasi/{donasi}', [App\Http\Controllers\DonasiController::class, 'destroy'])->name('donasi.destroy');
});

