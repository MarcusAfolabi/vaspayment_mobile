<?php

namespace App\Livewire\Airtime;

use Livewire\Component;
use Illuminate\Support\Str;
use App\Services\ApiEndpoints;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class BuyAirtimeForm extends Component
{
    public $network;
    public $amount;
    public $phone;
    public $userPhone;
    public $user;
    public $saveBeneficiary = false;
    public $beneficiaryName;
    public $errorMessage = null;
    public $isButtonDisabled = false;

    protected $rules = [
        'network' => 'required|string',
        'phone' => 'required|numeric|regex:/^\d{11}$/',
        'amount' => 'required|numeric|regex:/^[1-9]\d*$/|between:5,1000',
        'saveBeneficiary' => 'nullable|boolean',
        'beneficiaryName' => 'nullable',
    ];

    public function mount()
    {
        $this->user = Session::get('user');
        $this->userPhone = $this->user['phone'];
        if (strpos($this->userPhone, '234') === 0) {
            // Replace '234' with '0'
            $this->userPhone = '0' . substr($this->userPhone, 3);
        }
        $this->getAirtimeBeneficiaries();
    }

    protected function saveBeneficiary()
    {

        $body = [
            'user_id' => $this->user['id'],
            'product_type' => 'airtime',
            'list' => json_encode([
                [
                    'uuid' => (string) Str::uuid(),
                    'type' => 'airtime',
                    'provider' => $this->network,
                    'phone' => $this->phone,
                    'beneficiary_name' => $this->beneficiaryName,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            ]),
        ];
        $apiEndpoints = new ApiEndpoints();
        $headers = $apiEndpoints->header();
        $response = Http::withHeaders($headers)
            ->withBody(json_encode($body), 'application/json')
            ->post(ApiEndpoints::saveBeneficiary());
        if ($response->successful()) {
            $this->beneficiaries = $response->json()['data'] ?? [];
        } else {
            $this->addError('beneficiary', $response->json()['message']);
        }
    }
    public $balance;

    public function buyAirtime()
    {

        // Retrieve wallet information from the session
        $wallet = Session::get('wallet');
        $this->balance = (int) $wallet['balance'];

        // Check if balance is sufficient
        if ($this->balance < $this->amount) {
            $this->errorMessage = 'You have insufficient funds. Please fund your account to continue.';
            $this->isButtonDisabled = true;
            return;
        }

        $this->validate();

        if ($this->beneficiaryName) {
            $this->saveBeneficiary();
        }
        // Prepare API request body
        $body = [
            'network' => $this->network,
            'wallet_id' => $wallet['wallet_id'],
            'amount' => $this->amount,
            'phone' => $this->phone,
        ];

        // Send the API request
        $apiEndpoints = new ApiEndpoints();
        $response = Http::withHeaders($apiEndpoints->header())
            ->withBody(json_encode($body), 'application/json')
            ->post(ApiEndpoints::buyLocalAirtime());

        // Handle API response
        if ($response->successful()) {
            // Flash success message and redirect
            $this->errorMessage = null;
            $this->isButtonDisabled = false; // Enable the button
            Session::flash('success', $response->json()['message']);
            $this->refreshWalletSession();
            return redirect()->to('/airtime');
        } else {
            // Flash error message and redirect
            Session::flash('error', $response->json()['message']);
            return redirect()->to('/airtime');
        }
    }

    public function refreshWalletSession()
    {
        $wallet = DB::table('wallets')->where('user_id', $this->user['id'])->first();

        if ($wallet) {
            Session::put('wallet', [
                'wallet_id' => $wallet->wallet_id,
                'balance' => $wallet->balance,
                'commission' => $wallet->commission,
            ]);
            // Log::info('Wallet session refreshed: ', ['wallet_id' => $wallet->wallet_id, 'balance' => $wallet->balance, 'commission' => $wallet->commission]);
            return $wallet;
        } else {
            Log::error('Wallet not found for user ID: ' . Auth::user()->id);
            return null;
        }
    }


    public $beneficiaries;
    public function getAirtimeBeneficiaries()
    {
        $body = [
            'user_id' => $this->user['id'],
            'type' => 'Airtime',
        ];
        $apiEndpoints = new ApiEndpoints();
        $headers = $apiEndpoints->header();
        $response = Http::withHeaders($headers)
            ->withBody(json_encode($body), 'application/json')
            ->post(ApiEndpoints::beneficiaries());
        if ($response->successful()) {
            $this->beneficiaries = $response->json()['data'] ?? [];
        } else {
            $this->addError('beneficiary', $response->json()['message']);
        }
    }

    public function render()
    {
        return view('livewire.airtime.buy-airtime-form');
    }
}
