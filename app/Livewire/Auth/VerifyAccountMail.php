<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use App\Services\ApiEndpoints;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class VerifyAccountMail extends Component
{
    public $email;

    protected $rules = [
        "email" => "required|email|email_validation|exists:users,email",
    ];
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    public function confirmEmail()
    {

        $this->validate();
        try {
            $response = Http::post(ApiEndpoints::sendEmailOtp(), [
                'email' => $this->email,
            ]);

            if ($response->successful()) {
                $info = $response->json('message');
                Session::put('user_email', $this->email);
                Session::flash('success', $info);
                return redirect()->to('/verify-email');
            } else {
                $info = $response->body();
                Session::flash('error', $info);
            }
        } catch (\Throwable $th) {
            $info = $th->getMessage();
            Log::error($th->getMessage());
            Session::flash('error', $info); // Store exception message in session
        }
    }
    public function render()
    {
        return view('livewire.auth.verify-account-mail');
    }
}
