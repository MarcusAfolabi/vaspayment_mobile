<?php

namespace App\Livewire\Dashboard\User;

use Livewire\Component;
use App\Services\ApiEndpoints;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class Password extends Component
{
    public $emailx = true;
    public $email;
    public $otpSent = false;
    public $newPassword = false;

    public function updatedEmail()
    {
        $this->validate([
            "email" => "required|email|email_validation|exists:users,email",
        ]);
        try {
            $response = Http::post(ApiEndpoints::sendEmailOtp(), [
                'email' => $this->email,
            ]);

            if ($response->successful()) {
                $info = $response->json('message');
                $this->emailx = false;
                $this->otpSent = true;
                $this->addError('email_code', $info);
            } else {
                $info = $response->json()['message'];
                $this->addError('email', $info);
            }
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
        }
    }

    public $email_code;
    public function updatedEmailCode()
    {

        try {
            $this->validate([
                'email_code' => 'required|digits:6|exists:otp_verifications,otp',
            ]);
            $this->otpSent = false;
            $this->newPassword = true;
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            $this->addError('email_code', $th->getMessage());
        }
    }

    public $password;
    public function updatedPassword()
    {
        try {
            $this->validate([
                'password' => 'required|min:8',
            ]);
            $response = Http::post(ApiEndpoints::changePassword(), [
                'password' => $this->password,
            ]);
            if ($response->successful()) {
                $info = $response->json('message');
                Session::flash('success', $info);
                return redirect('/user/profile');
            } else {
                $info = $response->json()['message'];
                $this->addError('password', $info);
            }
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            $this->addError('password', $th->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.dashboard.user.password');
    }
}
