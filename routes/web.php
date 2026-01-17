<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\DonasiController;
use App\Http\Controllers\BansosController;
use App\Http\Controllers\ProgramBansosController;
use App\Http\Controllers\PenerimaBansosController;
use App\Http\Controllers\PenyaluranBansosController;
use App\Http\Controllers\GuestDonasiController;
use App\Http\Controllers\GuestProgramBansosController;
use App\Models\Bansos;

/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES (No Authentication Required)
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    $semua_bansos = Bansos::where('status', 'aktif')->get();
    return view('welcome', compact('semua_bansos'));
});

Route::get('/bansos/{id}', [BansosController::class, 'show'])->name('bansos.show');

Route::get('/donasi', [GuestDonasiController::class, 'index'])->name('donasi.public');
Route::get('/donasi/search', [GuestDonasiController::class, 'search'])->name('donasi.search');

/*
|--------------------------------------------------------------------------
| GUEST ROUTES - Public Registration & Info (No Auth Required)
|--------------------------------------------------------------------------
*/

Route::prefix('guest')->name('guest.')->group(function () {
    // Donasi Guest Routes
    Route::get('/donasi/search', [GuestDonasiController::class, 'search'])->name('donasi.search');
    Route::get('/donasi/create', [GuestDonasiController::class, 'create'])->name('donasi.create');
    Route::post('/donasi', [GuestDonasiController::class, 'store'])->name('donasi.store');

    // Program Bansos Info untuk Guest
    Route::get('program-bansos', [GuestProgramBansosController::class, 'index'])->name('program-bansos.index');
    Route::get('program-bansos/{programBansos}', [GuestProgramBansosController::class, 'show'])->name('program-bansos.show');

    // Penerima Bansos - Guest Registration
    Route::get('penerima-bansos/create', [PenerimaBansosController::class, 'create'])->name('penerima-bansos.create');
    Route::post('penerima-bansos', [PenerimaBansosController::class, 'store'])->name('penerima-bansos.store');
    Route::get('penerima-bansos/success', function() {
        return view('penerima-bansos.success');
    })->name('penerima-bansos.success');
});

/*
|--------------------------------------------------------------------------
| AUTHENTICATION ROUTES
|--------------------------------------------------------------------------
*/

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

/*
|--------------------------------------------------------------------------
| PASSWORD RESET ROUTES (Guest Middleware)
|--------------------------------------------------------------------------
*/

Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])
    ->middleware('guest')
    ->name('password.request');

Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])
    ->middleware('guest')
    ->name('password.email');

Route::get('/reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])
    ->middleware('guest')
    ->name('password.reset');

Route::post('/reset-password', [ResetPasswordController::class, 'reset'])
    ->middleware('guest')
    ->name('password.update');

/*
|--------------------------------------------------------------------------
| AUTHENTICATED ROUTES (All Logged-in Users)
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
    // Dashboard & Profile
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::patch('/profile/password', [ProfileController::class, 'password'])->name('profile.password');

    // User Donasi Request
    Route::get('/donasi/ajukan', [GuestDonasiController::class, 'index'])->name('donasi.user');
});

/*
|--------------------------------------------------------------------------
| ADMIN ROUTES
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'admin'])->group(function () {
    // User Management
    Route::resource('users', UserController::class);

    // Donasi Admin CRUD
    Route::resource('donasi', DonasiController::class);

    // Program Bansos Admin CRUD - Explicit routes to ensure correct parameter binding
    Route::get('program-bansos', [ProgramBansosController::class, 'index'])->name('program-bansos.index');
    Route::get('program-bansos/create', [ProgramBansosController::class, 'create'])->name('program-bansos.create');
    Route::post('program-bansos', [ProgramBansosController::class, 'store'])->name('program-bansos.store');
    Route::get('program-bansos/{programBansos}/edit', [ProgramBansosController::class, 'edit'])->name('program-bansos.edit');
    Route::put('program-bansos/{programBansos}', [ProgramBansosController::class, 'update'])->name('program-bansos.update');
    Route::delete('program-bansos/{programBansos}', [ProgramBansosController::class, 'destroy'])->name('program-bansos.destroy');

    // Penerima Bansos Admin CRUD - Explicit routes to ensure correct parameter binding
    Route::get('penerima-bansos/create', [PenerimaBansosController::class, 'create'])->name('penerima-bansos.create');
    Route::post('penerima-bansos', [PenerimaBansosController::class, 'store'])->name('penerima-bansos.store');
    Route::get('penerima-bansos/{penerimaBansos}/edit', [PenerimaBansosController::class, 'edit'])->name('penerima-bansos.edit');
    Route::put('penerima-bansos/{penerimaBansos}', [PenerimaBansosController::class, 'update'])->name('penerima-bansos.update');
    Route::delete('penerima-bansos/{penerimaBansos}', [PenerimaBansosController::class, 'destroy'])->name('penerima-bansos.destroy');

    // Bansos (Legacy - from admin prefix)
    Route::resource('bansos', BansosController::class);
});

/*
|--------------------------------------------------------------------------
| STAFF ROUTES
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'staff'])->group(function () {
    // Donasi Validation
    Route::get('donasi', [DonasiController::class, 'index'])->name('donasi.index');
    Route::post('donasi/{donasi}/validate', [DonasiController::class, 'validateDonasi'])->name('donasi.validate');
});

/*
|--------------------------------------------------------------------------
| ADMIN & STAFF ROUTES (Shared Access)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'adminOrStaff'])->group(function () {
    // Donasi View & Details
    Route::get('donasi', [DonasiController::class, 'index'])->name('donasi.index');
    Route::get('donasi/laporan', [DonasiController::class, 'laporan'])->name('donasi.laporan');
    Route::get('donasi/{donasi}', [DonasiController::class, 'show'])->name('donasi.show');
    Route::post('donasi/{donasi}/validate', [DonasiController::class, 'validateDonasi'])->name('donasi.validate');

    // Program Bansos Show Only
    Route::get('program-bansos/{programBansos}', [ProgramBansosController::class, 'show'])->name('program-bansos.show');

    // Penerima Bansos View & Verification
    Route::get('penerima-bansos', [PenerimaBansosController::class, 'index'])->name('penerima-bansos.index');
    Route::get('penerima-bansos/{penerimaBansos}', [PenerimaBansosController::class, 'show'])->name('penerima-bansos.show');
    Route::post('penerima-bansos/{penerimaBansos}/verifikasi', [PenerimaBansosController::class, 'verifikasi'])->name('penerima-bansos.verifikasi');
    Route::get('penerima-bansos/{penerimaBansos}/download/{filename}', [PenerimaBansosController::class, 'downloadDokumen'])->name('penerima-bansos.download');

    // Penyaluran Bansos
    Route::resource('penyaluran-bansos', PenyaluranBansosController::class)
    ->parameters([
        'penyaluran-bansos' => 'penyaluranBansos'
    ]);
});
