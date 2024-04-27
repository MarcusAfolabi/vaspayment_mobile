<?php

namespace App\Livewire\Auth;

use GuzzleHttp\Client;
use Livewire\Component;
use Jenssegers\Agent\Agent;
use Illuminate\Http\Request;
use App\Services\ApiEndpoints;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

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
        'name' => 'required|min:5|max:50',
        'email' => 'required|email|email_validation',
        'phone' => 'required|phone_number|max:11',
        'password' => 'required',
        'agreed' => 'required',
        'refer_id' => 'nullable',
        'location_data' => 'required',
        'device_data' => 'required',
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
    }
    public function register()
    {
        $this->validate();
        try {
            $response = Http::post(ApiEndpoints::register(), [
                'email' => $this->email,
                'name' => $this->name,
                'phone' => $this->phone,
                'refer_id' => $this->refer_id,
                'password' => $this->password,
                'location_data' => $this->location_data,
                'device_data' => $this->device_data,
            ]);

            if ($response->successful()) {
                $data = $response->json()['user'];
                $token = $response->json()['token'];
                // Store data and token in session
                session(['user_data' => $data]);
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
        return view('livewire.auth.register');
    }
}
