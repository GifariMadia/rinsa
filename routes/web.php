<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\TrackingController;
use App\Http\Controllers\ProfileController;

// ── Public Landing Page ───────────────────────────────────────────────────────
Route::get('/', function () {
    return view('home');
})->name('home');

// ── Authentication ────────────────────────────────────────────────────────────
Route::get('/login',  [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::post('/logout',[AuthController::class, 'logout'])->name('logout');

Route::get('/lacak',  [TrackingController::class, 'index'])->name('tracking');
Route::post('/lacak', [TrackingController::class, 'track'])->name('tracking.result');

// ── Authenticated System ──────────────────────────────────────────────────────
Route::middleware(['auth', 'active'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/dashboard/feedback/{order}', [DashboardController::class, 'submitFeedback'])->name('dashboard.feedback');

    Route::middleware('admin')->group(function () {
        // Orders
        Route::get('/orders',              [OrderController::class, 'index'])->name('orders.index');
        Route::get('/orders/create',       [OrderController::class, 'create'])->name('orders.create');
        Route::post('/orders',             [OrderController::class, 'store'])->name('orders.store');
        Route::get('/orders/{order}',      [OrderController::class, 'show'])->name('orders.show');
        Route::get('/orders/{order}/edit', [OrderController::class, 'edit'])->name('orders.edit');
        Route::put('/orders/{order}',      [OrderController::class, 'update'])->name('orders.update');
        Route::delete('/orders/{order}',   [OrderController::class, 'destroy'])->name('orders.destroy');

        // Customers
        Route::get('/customers',                 [CustomerController::class, 'index'])->name('customers.index');
        Route::get('/customers/create',          [CustomerController::class, 'create'])->name('customers.create');
        Route::post('/customers',                [CustomerController::class, 'store'])->name('customers.store');
        Route::get('/customers/{customer}/edit', [CustomerController::class, 'edit'])->name('customers.edit');
        Route::put('/customers/{customer}',      [CustomerController::class, 'update'])->name('customers.update');
        Route::delete('/customers/{customer}',   [CustomerController::class, 'destroy'])->name('customers.destroy');

        Route::get('/laporan', [ReportController::class, 'index'])->name('report');
    });

    // Profile
    Route::get('/profil',        [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profil/edit',   [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profil',        [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profil/duty',  [ProfileController::class, 'updateDutyStatus'])->name('profile.duty');
    Route::post('/profil/notes', [ProfileController::class, 'updateQuickNotes'])->name('profile.notes');
});