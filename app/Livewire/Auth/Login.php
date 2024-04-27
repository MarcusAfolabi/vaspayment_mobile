<?php

namespace App\Livewire\Auth;

use GuzzleHttp\Client;
use Livewire\Component;
use Jenssegers\Agent\Agent;
use Illuminate\Http\Request;
use App\Services\ApiEndpoints;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class Login extends Component
{
    public $email;
    public $password;
    public $remember_me;
    public $device_data;
    public $location_data;
    public $ip;
    public $key;
    public $errorMessage;
    public $loading = false;

    protected $rules = [
        'email' => 'required|email|email_validation',
        'password' => 'required',
        'location_data' => 'required',
        'device_data' => 'required',
        'remember_me' => 'required',
    ];

    public function mount(Request $request)
    {
        try {
            $this->loading = true;
            $agent = new Agent();
            $isPhone = $agent->isPhone() ? 'Yes' : 'No';
            $isDesktop = $agent->isDesktop() ? 'Yes' : 'No';
            $browser = $agent->browser();
            $browserVersion = $agent->version($browser);
            $os = $agent->platform();
            $OSversion = $agent->version($os);
            $this->device_data = "Is Phone: $isPhone, Is Desktop: $isDesktop, Browser Type: $browser, Browser Version: $browserVersion, OS Type: $os, OS Version: $OSversion";
        } catch (\Throwable $th) {
            $this->addError('device_data', 'Unable to get your device properties');
            Log::alert($th->getMessage());
        }

        try {
            $this->key = config('app.ipkey');
            $this->ip = $request->server('REMOTE_ADDR');
            $client = new Client();
            $response = $client->get("https://ipinfo.io/{$this->ip}?token={$this->key}");
            $body = $response->getBody()->getContents();
            $data = json_decode($body, true);
            $ip = $data['ip'] ?? '';
            $location = $data['loc'] ?? '';
            $city = $data['city'] ?? '';
            $region = $data['region'] ?? '';
            $country = $data['country'] ?? '';
            $org = $data['org'] ?? '';
            $postal = $data['postal'] ?? '';
            $this->location_data = "IP: $ip, LagLog: $location, City: $city, Region: $region, Country: $country, ISP: $org, PostalCode: $postal";
            $this->loading = false;
        } catch (\Throwable $th) {
            $this->addError('location_data', 'Unable to get your location data');
            Log::alert($th->getMessage());
        }
    }
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
         try {
            $response = Http::post(ApiEndpoints::login(), [
                'email' => $this->email,
                'password' => $this->password,
                'location_data' => $this->location_data,
                'device_data' => $this->device_data,
            ]);

            if ($response->successful()) {
                $data = $response->json()['user'];
                $wallet = $response->json()['wallet'];
                $bonus = $response->json()['bonus'];
                $token = $response->json()['token'];
                // Store data and token in session
                session(['user_data' => $data]);
                session(['user_wallet' => $wallet]);
                session(['user_bonus' => $bonus]);
                session(['user_token' => $token]);
                info($response->json());
                return redirect()->to('/dashboard');
            } else {
                $errorMessage = $response->json()['message'];
                info($errorMessage);
                $this->addError('email', $errorMessage);
            }
        } catch (\Exception $e) {
            info($e->getMessage());
            $this->addError('email', 'Login failed. Please try again with correct login detail');
        }
    }

    public function login()
    {
        $this->validate();
        try {
            $response = Http::post(ApiEndpoints::login(), [
                'email' => $this->email,
                'password' => $this->password,
                'location_data' => $this->location_data,
                'device_data' => $this->device_data,
            ]);

            if ($response->successful()) {
                $data = $response->json()['user'];
                $wallet = $response->json()['wallet'];
                $bonus = $response->json()['bonus'];
                $token = $response->json()['token'];
                // Store data and token in session
                session(['user_data' => $data]);
                session(['user_wallet' => $wallet]);
                session(['user_bonus' => $bonus]);
                session(['user_token' => $token]);
                info($response->json());
                return redirect()->to('/dashboard');
            } else {
                $errorMessage = $response->json()['message'];
                info($errorMessage);
                $this->addError('error', $errorMessage);
            }
        } catch (\Exception $e) {
            info($e->getMessage());
            $this->addError('error', 'Login failed. Please try again with correct login detail');
        }
    }
    public function render()
    {
        return view('livewire.auth.login');
    }
}
