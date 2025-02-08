<?php

namespace App\Livewire\Auth;
 
use Livewire\Component;
use Illuminate\Http\Request;
use App\Services\ApiEndpoints; 
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class Register extends Component
{
    public $email;
    public $name;
    public $lastname;
    public $phone;
    public $password;
    public $refer_id;
    public $agreed;
    public $device_data;
    public $ip;
    public $key;
    public $errorMessage;
    public $loading = false;

    protected $rules = [
        'name' => 'required|string|max:50',
        'lastname' => 'required|string|max:50',
        'email' => 'required|email|email_validation|unique:users,email',
        'phone' => 'required|digits:11|unique:users,phone',
        'password' => 'required',
        'agreed' => 'required',
        'refer_id' => 'nullable|digits:8|exists:wallets,wallet_id',
        'device_data' => 'required',
    ];

    public function mount(Request $request)
    {
        $this->device_data = Session::get('device_name');
    }

    public function updatedPhone($phone)
    {
        // Check if the phone number starts with '0'
        if (substr($phone, 0, 1) === '0') {
            // Remove the first character (0) and return the rest
            return substr($phone, 1);
        }

        // Return the phone number unchanged if it doesn't start with '0'
        return $phone;
    }

    // public function updated($propertyName)
    // {
    //     $this->validateOnly($propertyName);
    // }

   public $countryCode;
    public function register()
    {
        Session::put('user_email', $this->email);
        $this->validate();
        try {
            $response = Http::post(ApiEndpoints::register(), [
                'email' => $this->email,
                'name' => $this->name,
                'lastname' => $this->lastname,
                'phone' => $this->countryCode . (substr($this->phone, 0, 1) === '0' ? substr($this->phone, 1) : $this->phone),
                'refer_id' => $this->refer_id,
                'password' => $this->password,
                'device_data' => $this->device_data,
                'currency' => "₦",
            ]);

            if ($response->successful()) {
                $data = $response->json(); 
                Session::flash('success', $data['message']);
                return redirect()->to('/verify-email');
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
