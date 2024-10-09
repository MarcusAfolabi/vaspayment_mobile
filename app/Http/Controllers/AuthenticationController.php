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
        if ($token) {
            return redirect()->to('/welcome');
        }
        return null;
    }

    private function deviceName()
    {
        try {
            $device_name = $this->deviceService->getDeviceName();
            if ($redirect = $this->checkUserAndRedirect()) {
                return $redirect;
            }
            Session::put('device_name', $device_name);
        } catch (\Throwable $th) {
            Log::error('Error in deviceName: ' . $th->getMessage());
        }
    }

    public function login()
    {
        $this->deviceName();
        return view("auth.login");
    }

    public function register()
    {
        $this->deviceName();
        return view("auth.register");
    }

    public function forgetPassword()
    {
        $this->deviceName();
        return view("auth.forget-password");
    }

    public function resetPassword()
    {
        $this->deviceName();
        return view("auth.reset-password");
    }
    public function verifyEmail()
    {
        $this->deviceName();
        return view("auth.verify-email");
    }

    public function logout(Request $request)
    {
        $request->session()->forget("token");
        return redirect("/");
    }
}
