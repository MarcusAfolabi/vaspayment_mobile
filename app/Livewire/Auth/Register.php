<?php

namespace App\Livewire\Auth;

use App\Models\User;
use GuzzleHttp\Client;
use Livewire\Component;
use Jenssegers\Agent\Agent;
use Illuminate\Http\Request;
use App\Services\ApiEndpoints;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class Register extends Component
{
    public $email;
    public $name;
    public $phone;
    public $password;
    public $refer_id;
    public $agreed;
    public $device_data;
    public $location_data;
    public $ip;
    public $key;
    public $errorMessage;
    public $loading = false;

    protected $rules = [
        'name' => 'required|string|max:50',
        'email' => 'required|email|email_validation|unique:users,email',
        'phone' => 'required|digits:10|unique:users,phone',
        'password' => 'required|password_complexity',
        'agreed' => 'required',
        'refer_id' => 'nullable|digits:8|exists:wallets,wallet_id',
        'location_data' => 'required',
        'device_data' => 'required',
    ];

    public function mount(Request $request)
    {
        $this->device_data = Session::get('device_name');
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

   public $countryCode;
    public function register()
    {
        $this->validate();
        try {
            $response = Http::post(ApiEndpoints::register(), [
                'email' => $this->email,
                'name' => $this->name,
                'phone' => $this->countryCode . $this->phone,
                'refer_id' => $this->refer_id,
                'password' => $this->password,
                'location_data' => $this->location_data,
                'device_data' => $this->device_data,
                'currency' => "₦",
            ]);

            if ($response->successful()) {
                $data = $response->json()['user'];
                $wallet = $response->json()['wallet'];
                $bonus = $response->json()['bonus'];
                $token = $response->json()['token'];
                // Store data and token in session
                session(['user' => $data]);
                session(['wallet' => $wallet]);
                session(['bonus' => $bonus]);
                session(['token' => $token]);
                info($response->json());
                return redirect()->to('/dashboard');
            } else {
                $errorMessage = $response->json()['message'];
                info($errorMessage);
                $this->addError('error', $errorMessage);
            }
        } catch (\Exception $e) {
            info($e->getMessage());
            $this->addError('error', 'Register failed. Please try again with correct login detail');
        }
    }
    public function render()
    {
        return view('livewire.auth.register');
    }
}
