<?php

namespace App\Services;

use App\Models\Key;

class ApiEndpoints
{
    public static function VirtualFundingTransactions()
    {
        return self::baseUrl() . '/api/v1/get-funding-transactions';
    }
    public static function virtualAccount()
    {
        return self::baseUrl() . '/api/v1/get-virtual-account';
    }
    public static function dashboard()
    {
        return self::baseUrl() . '/api/v1/auth/dashboard';
    }
    public static function forget()
    {
        return self::baseUrl() . '/api/v1/auth/forget-password';
    }

    public static function login()
    {
        return self::baseUrl() . '/api/v1/auth/login';
    }

    public static function register()
    {
        return self::baseUrl() . '/api/v1/auth/register';
    }


    public static function baseUrl()
    {
        return config('app.api_base_url');
    }

    public function header()
    {
        // Retrieve token from session
        $token = session('user_token', '');

        $headers = [
            "Authorization" => "Bearer " . $token,
            "Accept" => "application/json",
            "Content-Type" => "application/json",
        ];
        return $headers;
    }
}
