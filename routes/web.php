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
        Route::get('/logout', 'logout')->name('logout');  
    }
);

Route::middleware(['token'])->group(function () {
    Route::get('dashboard', [HomeController::class, 'index'])->name('dashboard');
    Route::get('user/notification', [HomeController::class, 'userNotification'])->name('user.notification');
    Route::get('user/profile', [HomeController::class, 'userProfile'])->name('user.profile');
    Route::get('user/account', [HomeController::class, 'userAccount'])->name('user.account');
    Route::get('user/beneficiaries', [HomeController::class, 'userBeneficiaries'])->name('user.beneficiary');
    Route::get('user/password', [HomeController::class, 'userPassword'])->name('user.password');
    Route::get('user/settings', [HomeController::class, 'userSetting'])->name('user.settings');
    Route::get('user/helpdesk', [HomeController::class, 'userHelpdesk'])->name('user.helpdesk');
    Route::get('virtual-account', [HomeController::class, 'virtualAccount'])->name('virtual.account');
   
    Route::get('airtime', [HomeController::class, 'airtime'])->name('product.airtime.index');
    Route::get('airtime-transactions', [HomeController::class, 'airtimeTransactions'])->name('product.airtime.transactions');
    
    Route::get('data', [HomeController::class, 'data'])->name('product.data.index');
    Route::get('data-transactions', [HomeController::class, 'dataTransactions'])->name('product.data.transactions');

    Route::get('data', [HomeController::class, 'data'])->name('product.data.index');
    Route::get('data-transactions', [HomeController::class, 'dataTransactions'])->name('product.data.transactions');

    Route::get('cable', [HomeController::class, 'cable'])->name('product.cable.index');
    Route::get('cable-transactions', [HomeController::class, 'cableTransactions'])->name('product.cable.transactions');

    Route::get('power', [HomeController::class, 'power'])->name('product.power.index');
    Route::get('power-transactions', [HomeController::class, 'powerTransactions'])->name('product.power.transactions');
    
    Route::get('transfer', [HomeController::class, 'transfer'])->name('product.transfer.index');
  
    Route::get('products', [HomeController::class, 'allProducts'])->name('product.all');
});
Route::get('insight/all', [HomeController::class, 'allInsight'])->name('all.insight');
Route::get('insight/{slug}', [HomeController::class, 'showInsight'])->name('show.insight');

Route::middleware(['token'])->group(function () {
    Route::get('all-transactions', [TransactionController::class, 'allTransactions'])->name('all.transactions');
});