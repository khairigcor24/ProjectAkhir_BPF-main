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

// ============================================
// PENERIMA BANSOS - ADMIN OR STAFF ROUTES
// ============================================
Route::middleware(['auth', 'adminOrStaff'])->group(function () {
    Route::get('penerima-bansos', [App\Http\Controllers\PenerimaBansosController::class, 'index'])->name('penerima-bansos.index');
    Route::get('penerima-bansos/{penerimaBansos}', [App\Http\Controllers\PenerimaBansosController::class, 'show'])->name('penerima-bansos.show');
    Route::post('penerima-bansos/{penerimaBansos}/verify', [App\Http\Controllers\PenerimaBansosController::class, 'verify'])->name('penerima-bansos.verify');
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

// ============================================
// PENYALURAN BANSOS - ADMIN OR STAFF ROUTES
// ============================================
Route::middleware(['auth', 'adminOrStaff'])->group(function () {
    Route::resource('penyaluran-bansos', App\Http\Controllers\PenyaluranBansosController::class);
});
