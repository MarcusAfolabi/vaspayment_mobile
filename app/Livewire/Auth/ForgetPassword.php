<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use App\Services\ApiEndpoints;
use Illuminate\Support\Facades\Http;

class ForgetPassword extends Component
{
    public $email;

    protected $rules = [
        'email' => 'required|string|email|email_validation',
    ];
    public function forget()
    {
        info('1');
        $this->validate();
        info('1');
        try {
            $response = Http::post(ApiEndpoints::forget(), [
                'email' => $this->email,
            ]);
            info($response->json());
            if ($response->successful()) {
                $message = $response->json()['message'];
                info($message);
                session()->flash('status', $message);
            } else {
                $errorMessage = $response->json()['message'];
                info($errorMessage);
                $this->addError('email', $errorMessage);
            }
        } catch (\Exception $e) {
            info($e->getMessage());
            $this->addError('error', 'Email failed. Please try again');
        }
    }
    public function render()
    {
        return view('livewire.auth.forget-password');
    }
}
