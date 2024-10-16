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
                Session::flash('success','Welcome back, ' . $data['name']);
                return redirect()->to('/dashboard');
            } else {
                $this->addError('password', $response->json()['message']);
            }
        } catch (\Exception $e) {
            $this->addError('password', $e->getMessage());
        }
    }
    public function render()
    {
        return view('livewire.auth.login');
    }
}
