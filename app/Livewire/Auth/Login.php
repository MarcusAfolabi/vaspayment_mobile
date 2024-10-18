<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Illuminate\Http\Request;
use App\Services\ApiEndpoints;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class Login extends Component
{
    public $email;
    public $password;
    public $remember_me;
    public $device_data;

    protected $rules = [
        'email' => 'required|email|email_validation',
        'password' => 'required',
        'device_data' => 'required',
        'remember_me' => 'sometimes',
    ];

    public function mount()
    {
        $this->device_data = Session::get('device_name');
    }

    public function login()
    {
        $this->validate();
        try {
            $body = [
                'email' => $this->email,
                'password' => $this->password,
                'device_data' => $this->device_data,
            ];

            $response = Http::get(ApiEndpoints::login(), $body);

            if ($response->successful()) {
                $data = $response->json()['user'];
                $wallet = $response->json()['wallet'];
                $bonus = $response->json()['bonus'];
                $token = $response->json()['token'];
                $virtualAccount = $response->json()['virtualAccount'];

                // Store data and token in session
                session(['user' => $data]);
                session(['wallet' => $wallet]);
                session(['bonus' => $bonus]);
                session(['token' => $token]);
                session(['virtualAccount' => $virtualAccount]);
                Session::flash('success', 'Thank you for your patronage, ' . $data['name']);

                if (empty(Session::get('virtualAccount'))) {
                    $this->createVirtualAccount();
                }
                return redirect()->to('/dashboard');
            } else {
                $this->addError('password', $response->json()['message']);
            }
        } catch (\Exception $e) {
            $this->addError('password', $e->getMessage());
        }
    }

    public function createVirtualAccount()
    {
        if (empty(Session::get('virtualAccount'))) {
            $user = Session::get('user');
            $nin = $user['phone'];
            $nin = substr(preg_replace('/\D/', '', $nin), 0, 11);

            try {
                $body = [
                    'nin' => $nin,
                    'email' => $user['email'],
                    'name' => $user['name'],
                    'lastname' => $user['lastname'] ?? $user['name'],
                    'phone' => $user['phone'],
                ];
                $apiEndpoints = new ApiEndpoints();
                $headers = $apiEndpoints->header();

                $response = Http::withHeaders($headers)
                    ->withBody(json_encode($body), 'application/json')
                    ->post(ApiEndpoints::createBudPayVirtualAccount());

                if ($response->successful()) {
                    $data = $response->json()['data'];
                    Session::put("virtualAccount", $data);
                } else {
                    info("Failed to create virtual account: " . $response->json()['message']);
                }
            } catch (\Throwable $th) {
                info("Error creating virtual account: " . $th->getMessage());
            }
        }
    }

    public function render()
    {
        return view('livewire.auth.login');
    }
}
