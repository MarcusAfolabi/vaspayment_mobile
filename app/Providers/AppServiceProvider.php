<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Validator::extend('password_complexity', function ($attribute, $value, $parameters, $validator) {
            return preg_match('/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/', $value);
        }, 'The :attribute must include a letter, a number, a special character, and be 8-16 characters long.');

        Validator::extend('email_validation', function ($attribute, $value, $parameters, $validator) {
            $allowedDomains = ['gmail.com', 'yahoo.com', 'hotmail.com', 'outlook.com'];
            $domain = substr(strrchr($value, "@"), 1);
            return in_array($domain, $allowedDomains);
        }, "The :attribute validation failed. Please try another email.");

        Validator::extend('phone_number', function ($attribute, $value, $parameters, $validator) {
            return preg_match('/^0(?:70|71|80|81|90|91)[0-9]{8}$/', $value) && strlen($value) <= 10;
        }, 'The :attribute number is incomplete, must be maximum of 10 digits.');
    }
}
