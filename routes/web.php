<?php
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PortfolioController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'home')->name('home');

Route::middleware('guest')->group(function () {
    Route::get('/login', fn () => app(AuthController::class)->show('login'))->name('login');
    Route::get('/register', fn () => app(AuthController::class)->show('register'))->name('register');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [PortfolioController::class, 'dashboard'])->name('dashboard');
    Route::put('/dashboard', [PortfolioController::class, 'update'])->name('dashboard.update');
});

Route::get('/u/{username}', [PortfolioController::class, 'show'])->name('portfolio.show');
