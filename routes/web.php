<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DonasiController;
use App\Http\Controllers\BansosController;
use App\Http\Controllers\PenerimaBansosController;
use App\Http\Controllers\GuestDonasiController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
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

Route::get('/bansos/{id}', [BansosController::class, 'show'])->name('bansos.show');

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
| LUPA DAN RESET PASSWORD KETIKA LOGIN
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
| ADMIN ROUTES
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    // Kelola Staff
    Route::resource('users', UserController::class);

    // CRUD Bansos
    // Route::resource('bansos', BansosController::class);

    // Laporan
    // Route::get('laporan', [LaporanController::class, 'index'])->name('laporan');
});

/*
|--------------------------------------------------------------------------
| STAFF ROUTES
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'staff'])->prefix('staff')->name('staff.')->group(function () {
    // CRUD terbatas, misal validasi donasi
    Route::get('donasi', [DonasiController::class, 'index'])->name('donasi.index');
    Route::post('donasi/{donasi}/validate', [DonasiController::class, 'validateDonasi'])->name('donasi.validate');
});

// ============================================
// GUEST ROUTES (Public - No Auth Required)
// ============================================
Route::prefix('guest')->name('guest.')->group(function () {
    Route::get('/donasi/search', [App\Http\Controllers\GuestDonasiController::class, 'search'])->name('donasi.search');
    Route::get('/donasi/create', [App\Http\Controllers\GuestDonasiController::class, 'create'])->name('donasi.create');
    Route::post('/donasi', [App\Http\Controllers\GuestDonasiController::class, 'store'])->name('donasi.store');
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

// ============================================
// ADMIN ONLY CRUD ROUTES (Must be before routes with parameters)
// ============================================
Route::middleware(['auth', 'admin'])->group(function () {
    // Donasi CRUD
    Route::get('donasi/create', [DonasiController::class, 'create'])->name('donasi.create');
    Route::post('donasi', [DonasiController::class, 'store'])->name('donasi.store');
    Route::get('donasi/{donasi}/edit', [DonasiController::class, 'edit'])->name('donasi.edit');
    Route::put('donasi/{donasi}', [DonasiController::class, 'update'])->name('donasi.update');
    Route::delete('donasi/{donasi}', [DonasiController::class, 'destroy'])->name('donasi.destroy');

    // Program Bansos CRUD
    Route::resource('program-bansos', App\Http\Controllers\ProgramBansosController::class)->except(['show']);
});

// ============================================
// PROGRAM BANSOS - ADMIN OR STAFF ROUTES
// ============================================
Route::middleware(['auth', 'adminOrStaff'])->group(function () {
    Route::get('program-bansos/{programBansos}', [App\Http\Controllers\ProgramBansosController::class, 'show'])->name('program-bansos.show');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/users', [UserController::class, 'index'])
        ->name('user.index');
});


// ============================================
// PENERIMA BANSOS - ADMIN OR STAFF ROUTES
// ============================================
Route::middleware(['auth', 'adminOrStaff'])->group(function () {
    Route::get('penerima-bansos', [PenerimaBansosController::class, 'index'])->name('penerima-bansos.index');
    Route::get('penerima-bansos/{penerimaBansos}', [PenerimaBansosController::class, 'show'])->name('penerima-bansos.show');
    Route::post('penerima-bansos/{penerimaBansos}/verifikasi',
        [PenerimaBansosController::class, 'verifikasi'])
    ->name('penerima-bansos.verifikasi');
    Route::get('penerima-bansos/{penerimaBansos}/download/{filename}',
        [PenerimaBansosController::class, 'downloadDokumen'])
        ->name('penerima-bansos.download');
});

// ============================================
// PENERIMA BANSOS - ADMIN ONLY CRUD
// ============================================
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('penerima-bansos/create', [App\Http\Controllers\PenerimaBansosController::class, 'create'])->name('penerima-bansos.create');
    Route::post('penerima-bansos', [App\Http\Controllers\PenerimaBansosController::class, 'store'])->name('penerima-bansos.store');
    Route::get('penerima-bansos/{penerimaBansos}/edit', [App\Http\Controllers\PenerimaBansosController::class, 'edit'])->name('penerima-bansos.edit');
    Route::put('penerima-bansos/{penerimaBansos}', [App\Http\Controllers\PenerimaBansosController::class, 'update'])->name('penerima-bansos.update');
    Route::delete('penerima-bansos/{penerimaBansos}', [App\Http\Controllers\PenerimaBansosController::class, 'destroy'])->name('penerima-bansos.destroy');
});

// ============================================
// PENERIMA BANSOS - GUEST ROUTES (Public Pendaftaran)
// ============================================
Route::prefix('guest')->name('guest.')->group(function () {
    // Info Program Bansos untuk Guest
    Route::get('program-bansos', [App\Http\Controllers\GuestProgramBansosController::class, 'index'])->name('program-bansos.index');
    Route::get('program-bansos/{programBansos}', [App\Http\Controllers\GuestProgramBansosController::class, 'show'])->name('program-bansos.show');

    // Pendaftaran Penerima Bansos
    Route::get('penerima-bansos/create', [App\Http\Controllers\PenerimaBansosController::class, 'create'])->name('penerima-bansos.create');
    Route::post('penerima-bansos', [App\Http\Controllers\PenerimaBansosController::class, 'store'])->name('penerima-bansos.store');
    Route::get('penerima-bansos/success', function() {
        return view('penerima-bansos.success');
    })->name('penerima-bansos.success');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/donasi/ajukan', [GuestDonasiController::class, 'index'])
        ->name('donasi.user');
});

// ============================================
// PENYALURAN BANSOS - ADMIN OR STAFF ROUTES
// ============================================
Route::middleware(['auth', 'adminOrStaff'])->group(function () {
    Route::resource('penyaluran-bansos', App\Http\Controllers\PenyaluranBansosController::class);
});
