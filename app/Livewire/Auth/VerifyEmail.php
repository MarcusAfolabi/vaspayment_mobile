<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use App\Services\ApiEndpoints;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class VerifyEmail extends Component
{
    public $email_otp;

    protected $rules = [
        'email_otp' => 'required|digits:6',
    ];

    public function confirmEmail()
    {
        try {
            $email = Session::get('user_email');
            $this->validate();
            $response = Http::post(ApiEndpoints::verifyEmail(), [
                'email' => $email,
                'otp' => $this->email_otp,
            ]);

            if ($response->successful()) {
                $info = $response->json()['message'];
                Session::flash("success", $info);
                return redirect()->to('/login');
            } else {
                $info = $response->json()['message'];
                $this->addError('email_otp', $info);
                Session::flash("error", $info);
            }
        } catch (\Throwable $th) {
            $info = $th->getMessage();
            Session::flash("error", $info);
            Log::error($th->getMessage());
            $this->addError('email_otp', $info);
        }
    }
    public function render()
    {
        return view('livewire.auth.verify-email');
    }
}
