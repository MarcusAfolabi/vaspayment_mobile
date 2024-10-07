<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
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
        Route::get('/login', 'login')->name('login');
        Route::get('/register', 'register')->name('register');
        Route::get('/forget-password', 'forgetPassword')->name('forget.password');
        // Route::post('/logout', 'logout')->name('logout');
        
    }
);
Route::post('logout', [AuthenticationController::class, 'logout'])->name('logout');

Route::middleware(['token'])->group(function () {
    Route::get('/', [HomeController::class, 'home'])->name('home');
    Route::get('dashboard', [HomeController::class, 'index'])->name('dashboard');
    Route::get('virtual-account', [HomeController::class, 'virtualAccount'])->name('virtual.account');
    Route::get('airtime', [HomeController::class, 'airtime'])->name('airtime.index');
    Route::get('airtime-transactions', [HomeController::class, 'airtimeTransactions'])->name('airtime.transactions');
});

Route::get('/nin', function () {
    return view('dashboard.nin');
});

