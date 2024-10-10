<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use App\Services\ApiEndpoints;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class ResetPassword extends Component
{
    public $email;
    public $email_code;
    public $password;

    protected $rules = [
        "password" => "required|string|password_complexity",
        "email_code" => "required|digits:6|exists:otp_verifications,otp",
    ];


    public function resetPassword()
    {
        $this->validate();
        try {
            $email = session('user_forget_email');
            $response = Http::post(ApiEndpoints::resetPassword(), [
                'email' => $email,
                'password' => $this->password,
                'otp' => $this->email_code,
            ]);

            if ($response->successful()) {
                Session::flash("success", $response->json()['message']);
                return redirect()->to('/login');
            } else {
                $this->addError('password', $response->json()['data']);
            }
        } catch (\Throwable $th) {
            $this->addError('password', $th->getMessage());
        }
    }
    public function render()
    {
        return view('livewire.auth.reset-password');
    }
}
