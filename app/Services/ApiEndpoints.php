<?php

namespace App\Services;

use App\Models\Key;

class ApiEndpoints
{
    public static function buyDataBundle()
    {
        return self::baseUrl() . '/buy-data-bundle';
    }
    public static function dataBundles()
    {
        return self::baseUrl() . '/get-data-bundles';
    }
    public static function dataNetworks()
    {
        return self::baseUrl() . '/get-data-networks';
    }
    public static function buyLocalAirtime()
    {
        return self::baseUrl() . '/buy-airtime';
    }
    public static function saveBeneficiary()
    {
        return self::baseUrl() . '/save-beneficiary';
    }
    public static function beneficiaries()
    {
        return self::baseUrl() . '/get-beneficiaries';
    }
    public static function DataTransactions()
    {
        return self::baseUrl() . '/get-data-transactions';
    }
    public static function airtimeTransactions()
    {
        return self::baseUrl() . '/get-airtime-transactions';
    }
    
    public static function verifyNIN()
    {
        return self::baseUrl() . '/verify-nin';
    }
    public static function VirtualFundingHistory()
    {
        return self::baseUrl() . '/get-funding-history';
    }

    public static function userTransactions()
    {
        return self::baseUrl() . '/get-latest-transactions';
    }
    public static function userNotification()
    {
        return self::baseUrl() . '/get-user-notifications';
    }

    public static function virtualAccount()
    {
        return self::baseUrl() . '/get-virtual-account';
    }
    public static function createMonnifyVirtualAccount()
    {
        return self::baseUrl() . '/monnify-virtual-account';
    }
    public static function createBudPayVirtualAccount()
    {
        return self::baseUrl() . '/budpay-virtual-account';
    }

    public static function dashboard()
    {
        return self::baseUrl() . '/auth/dashboard';
    }
    public static function forgetPassword()
    {
        return self::baseUrl() . '/auth/forget-password';
    }
    public static function resetPassword()
    {
        return self::baseUrl() . '/auth/reset-password';
    }
    public static function verifyEmail()
    {
        return self::baseUrl() . '/auth/verify-email';
    }
    public static function sendEmailOtp()
    {
        return self::baseUrl() . '/auth/send-email-otp';
    }

    public static function login()
    {
        return self::baseUrl() . '/auth/login';
    }

    public static function register()
    {
        return self::baseUrl() . '/auth/register';
    }


    public static function baseUrl()
    {
        return config('app.api_base_url');
    }

    public function header()
    {
        // Retrieve token from session
        $token = session('token', '');

        $headers = [
            "Authorization" => "Bearer " . $token,
            "Accept" => "application/json",
            "Content-Type" => "application/json",
        ];
        return $headers;
    }
}
