<?php

namespace App\Services;

use App\Models\Key;

class ApiEndpoints
{
    public static function allBlog()
    {
        return self::baseUrl() . '/blogs';
    }
    
    public static function showBlog()
    {
        return self::baseUrl() . '/blog/show';
    }
    public static function buyCableSubscription()
    {
        return self::baseUrl() . '/buy-cable-subscription';
    }
    
    public static function queryDecoderNo()
    {
        return self::baseUrl() . '/query-decoder-no';
    }

    public static function getCablePackage()
    {
        return self::baseUrl() . '/get-cable-packages';
    }

    public static function buyElectricity()
    {
        return self::baseUrl() . '/buy-meter-token';
    }

    public static function queryMeterNo()
    {
        return self::baseUrl() . '/query-meter-no';
    }

    public static function electricityTypes()
    {
        return self::baseUrl() . '/get-electricity-type';
    }
    public static function Transactions()
    {
        return self::baseUrl() . '/get-transactions';
    }
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

    public static function updateAccount()
    {
        return self::baseUrl() . '/update-user-account';
    }
    public static function updatePassword()
    {
        return self::baseUrl() . '/update-user-password';
    }
    public static function updateNotification()
    {
        return self::baseUrl() . '/update-user-notification';
    }

    public static function getBeneficiary()
    {
        return self::baseUrl() . '/get-user-beneficiary';
    }
    public static function updateBenficiary()
    {
        return self::baseUrl() . '/update-user-beneficiary';
    }

    public static function dashboard()
    {
        return self::baseUrl() . '/auth/dashboard';
    }
    public static function forgetPassword()
    {
        return self::baseUrl() . '/auth/forget-password';
    }
    public static function changePassword()
    {
        return self::baseUrl() . '/change-user-password';
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
