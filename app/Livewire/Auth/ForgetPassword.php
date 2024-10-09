<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use App\Services\ApiEndpoints;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class ForgetPassword extends Component
{
    public $email;
    public $device_data;

    protected $rules = [
        'email' => 'required|string|email|email_validation',
        'device_data' => 'required',
    ];
    public function mount()
    {
        $this->device_data = Session::get('device_name');
    }
   
    public function forget()
    {
        try {
            $this->validate();
            $response = Http::post(ApiEndpoints::forgetPassword(), [
                'email' => $this->email,
                'device_data' => $this->device_data,
            ]);
            if ($response->successful()) { 
                  session(['user_forget_email' => $this->email]);
                Session::flash("success", $response->json()['message']);
                return redirect('/reset-password');
            } else {
                $errorMessage = $response->json()['message'];
                $this->addError('email', $errorMessage);
            }
        } catch (\Exception $e) {
            info($e->getMessage());
            $this->addError('email', $e->getMessage());
        }
    }
    public function render()
    {
        return view('livewire.auth.forget-password');
    }
}
