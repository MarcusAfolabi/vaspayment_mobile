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
                $responseData = $response->json();


                // Store data and token in session
                $data = $responseData['user'];
                $wallet = $responseData['wallet'] ?? null;
                $bonus = $responseData['bonus'] ?? null;
                $token = $responseData['token'] ?? null;
                $apiToken = $responseData['apiToken'] ?? null;
                $virtualAccount = $responseData['virtualAccount'];

                // Store user data and token in session
                session(['user' => $data, 'wallet' => $wallet, 'bonus' => $bonus, 'token' => $token, 'apiToken' => $apiToken]);

                // Check if virtual account exists before creating it
                if (empty($virtualAccount)) {
                    $this->createVirtualAccount();
                }

                Session::flash('success', 'Thank you for your patronage, ' . $data['name']);
                return redirect()->to('/dashboard');
            } else {
                $this->addError('password', $response->json()['message']);
            }
        } catch (\Exception $e) {
            $this->addError('password', $e->getMessage());
        }
    }



    // public function createVirtualAccount()
    // {
    //         $user = Session::get('user');
    //         $nin = $user['phone'];
    //         $nin = substr(preg_replace('/\D/', '', $nin), 0, 11);

    //         try {
    //             $body = [
    //                 'nin' => $nin,
    //                 'email' => $user['email'],
    //                 'name' => $user['name'],
    //                 'lastname' => $user['lastname'] ?? 'Guest' ,
    //                 'phone' => $nin,
    //             ];

    //             $apiEndpoints = new ApiEndpoints();
    //             $headers = $apiEndpoints->header();

    //             $response = Http::withHeaders($headers)
    //                 ->withBody(json_encode($body), 'application/json')
    //                 ->post(ApiEndpoints::createBudPayVirtualAccount());

    //             if ($response->successful()) {
    //                 $data = $response->json()['data'];
    //                 session(['virtualAccount' => $data]);
    //             } else {
    //                 info("Failed to create virtual account: " . $response->json()['message']);
    //             }
    //         } catch (\Throwable $th) {
    //             info("Error creating virtual account: " . $th->getMessage());
    //         } 
    // }


    public function createVirtualAccount()
    {
        $user = Session::get('user');
        $nin = $user['phone'];
        $nin = substr(preg_replace('/\D/', '', $nin), 0, 11);

        try {
            $body = [
                'nin' => $nin,
                'email' => $user['email'],
                'name' => $user['name'],
                'lastname' => $user['lastname'] ?? 'Guest',
                'phone' => $nin,
            ];

            $apiEndpoints = new ApiEndpoints();
            $headers = $apiEndpoints->header();

            $response = Http::withHeaders($headers)
                ->withBody(json_encode($body), 'application/json')
                ->post(ApiEndpoints::createBudPayVirtualAccount());

            if ($response->successful()) {
                $data = $response->json()['data'];
                session(['virtualAccount' => $data]);
            } else {
                $errorMessage = $response->json()['message'] ?? 'Unknown error';
                info("Failed to create virtual account: " . $errorMessage);

                if (str_contains($errorMessage, 'The phone has already been taken')) {
                    // Generate random phone number and lastname
                    $randomPhone = '090' . mt_rand(10000000, 99999999);
                    $randomLastName = $this->generateRandomName();

                    // Retry with new phone and lastname
                    $body['phone'] = $randomPhone;
                    $body['lastname'] = $randomLastName;

                    $retryResponse = Http::withHeaders($headers)
                        ->withBody(json_encode($body), 'application/json')
                        ->post(ApiEndpoints::createBudPayVirtualAccount());

                    if ($retryResponse->successful()) {
                        $data = $retryResponse->json()['data'];
                        session(['virtualAccount' => $data]);
                    } else {
                        info("Retry failed: " . $retryResponse->json()['message']);
                    }
                }
            }
        } catch (\Throwable $th) {
            info("Error creating virtual account: " . $th->getMessage());
        }
    }

    private function generateRandomName()
    {
        $names = ['Smith', 'Johnson', 'Williams', 'Brown', 'Jones', 'Garcia', 'Miller', 'Davis', 'Rodriguez', 'Martinez'];
        return $names[array_rand($names)];
    }


    public function render()
    {
        return view('livewire.auth.login');
    }
}
