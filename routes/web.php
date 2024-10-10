<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\AuthenticationController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::controller(AuthenticationController::class)->group(
    function () {
        Route::get('/', 'home')->name('home');
        Route::get('/login', 'login')->name('login');
        Route::get('/register', 'register')->name('register');
        Route::get('/forget-password', 'forgetPassword')->name('forget.password');
        Route::get('/reset-password', 'resetPassword')->name('reset.password');
        Route::get('/verify-email', 'verifyEmail')->name('verify.email');
        Route::get('/verify-email-account', 'verifyEmailAccount')->name('verify.email.account');
        Route::get('/logout', 'logout')->name('logout')->middleware('token');  
    }
);
Route::post('logout', [AuthenticationController::class, 'logout'])->name('logout');

Route::middleware(['token'])->group(function () {
    Route::get('dashboard', [HomeController::class, 'index'])->name('dashboard');
    Route::get('virtual-account', [HomeController::class, 'virtualAccount'])->name('virtual.account');
    Route::get('airtime', [HomeController::class, 'airtime'])->name('airtime.index');
    Route::get('airtime-transactions', [HomeController::class, 'airtimeTransactions'])->name('airtime.transactions');
});

Route::middleware(['token'])->group(function () {
    Route::get('all-transactions', [TransactionController::class, 'allTransactions'])->name('all.transactions');
});

Route::get('/nin', function () {
    return view('dashboard.nin');
});

