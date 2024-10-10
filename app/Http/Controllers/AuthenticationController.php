<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\DeviceService;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class AuthenticationController extends Controller
{
    protected $deviceService;

    public function __construct(DeviceService $deviceService)
    {
        $this->deviceService = $deviceService;
    }

    protected function checkUserAndRedirect()
    {
        $token = Session::get("token");
        if ($token != null) {
            return redirect()->route('dashboard');
        }
        return null;
    }

    private function deviceName()
    {
        try {
            $device_name = $this->deviceService->getDeviceName();
            Session::put('device_name', $device_name);
        } catch (\Throwable $th) {
            Log::error('Error in deviceName: ' . $th->getMessage());
        }
    }

    public function home()
    {
        $this->deviceName();
        if ($redirect = $this->checkUserAndRedirect()) {
            return $redirect;
        }
        return view("welcome");
    }
    public function login()
    {
        $this->deviceName();
        if ($redirect = $this->checkUserAndRedirect()) {
            return $redirect;
        }        return view("auth.login");
    }

    public function register()
    {
        if ($redirect = $this->checkUserAndRedirect()) {
            return $redirect;
        }
        $this->deviceName();
        return view("auth.register");
    }

    public function forgetPassword()
    {
        if ($redirect = $this->checkUserAndRedirect()) {
            return $redirect;
        }
        $this->deviceName();
        return view("auth.forget-password");
    }

    public function resetPassword()
    {
        if ($redirect = $this->checkUserAndRedirect()) {
            return $redirect;
        }
        $this->deviceName();
        return view("auth.reset-password");
    }
    public function verifyEmail()
    {
        // if ($redirect = $this->checkUserAndRedirect()) {
        //     return $redirect;
        // }
        $this->deviceName();
        return view("auth.verify-email");
    }
    public function verifyEmailAccount()
    {
        // if ($redirect = $this->checkUserAndRedirect()) {
        //     return $redirect;
        // }
        $this->deviceName();
        return view("auth.verify-account-mail");
    }


    public function logout(Request $request)
    {
        $request->session()->forget("token");
        return redirect("/");
    }
}
