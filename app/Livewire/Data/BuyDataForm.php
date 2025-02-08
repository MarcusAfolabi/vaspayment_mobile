<?php

namespace App\Livewire\Data;

use Livewire\Component;
use Illuminate\Support\Str;
use App\Services\ApiEndpoints;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class BuyDataForm extends Component
{
    public $networkProvider;
    public $amount;
    public $phone;
    public $user;
    public $userPhone;
    public $saveBeneficiary = false;
    public $beneficiaryName;

    public $errorMessage = null;
    public $isButtonDisabled = false;
    public $networks;
    public $network;
    public $biller;
    public $balance;
    public $bundles;
    public $selectedNetwork = '';
    public $selectedName = '';
    public $beneficiaries;

    protected $rules = [
        'selectedNetwork' => 'required|string',
        'selectedBundle' => 'required|string',
        'allowance' => 'required|string',
        'validity' => 'required|string',
        'phone' => 'required|numeric|regex:/^\d{11}$/',
        'resellerPrice' => 'required',
        'saveBeneficiary' => 'nullable|boolean',
        'beneficiaryName' => 'nullable|string|required_if:saveBeneficiary,true',
    ];

    public function mount()
    {
        $this->user = Session::get('user');
        $this->userPhone = $this->user['phone'];
        if (strpos($this->userPhone, '234') === 0) {
            // Replace '234' with '0'
            $this->userPhone = '0' . substr($this->userPhone, 3);
        }
        $this->getDataBeneficiaries();
        $this->getDataNetwork();
    }

    public function getDataBeneficiaries()
    {
        $body = [
            'user_id' => $this->user['id'],
            'type' => 'data',
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


    public function getDataNetwork()
    {

        $apiEndpoints = new ApiEndpoints();
        $headers = $apiEndpoints->header();
        $response = Http::withHeaders($headers)
            ->post(ApiEndpoints::dataNetworks());
        if ($response->successful()) {
            $this->networks = $response->json()['data'] ?? [];
            $this->biller = $response->json()['biller_name'] ?? [];
        } else {
            $this->addError('beneficiary', $response->json()['message']);
        }
    }

    public function updatedSelectedNetwork()
    {
        $networkData = explode('/', $this->selectedNetwork);
        $this->selectedName = trim($networkData[0]);
        $this->selectedNetwork = trim($networkData[1]);
        $body = [
            'selected_network' => $this->selectedNetwork,
            'selected_name' => $this->selectedName,
            'biller' => $this->biller,
        ];

        $apiEndpoints = new ApiEndpoints();
        $headers = $apiEndpoints->header();
        $response = Http::withHeaders($headers)
            ->withBody(json_encode($body), 'application/json')
            ->post(ApiEndpoints::dataBundles());
        if ($response->successful()) {
            $this->reset(['selectedBundle', 'resellerPrice']);
            $this->bundles = $response->json()['data'] ?? [];
        } else {
            $this->addError('beneficiary', $response->json()['message']);
        }
    }

    public $selectedBundle;
    public $selectedBundleCode;
    public $resellerPrice;
    public $allowance;
    public $validity;
    public $selectedBundleName;

    public function updatedSelectedBundle()
    {
        if ($this->selectedBundle) {
            // Split the selected bundle into its components
            $bundleData = explode('/', $this->selectedBundle);
            $this->selectedBundleCode = $bundleData[0]; // Bundle code
            $this->selectedBundleName = $bundleData[1]; // Bundle code
            $this->selectedNetwork = $bundleData[2]; // Network
            $this->amount = $bundleData[3]; // Reseller price
            $this->resellerPrice = '₦' . number_format($bundleData[3]); // Reseller price
            $this->allowance = $bundleData[4]; // Allowance
            $this->validity = $bundleData[5]; // Validity
        } else {
            $this->addError('selectedBundle', 'Select your bundle type');
        }
    }

    protected function saveBeneficiary()
    {

        $body = [
            'user_id' => $this->user['id'],
            'product_type' => 'data',
            'list' => json_encode([
                [
                    'uuid' => Str::uuid(),
                    'type' => 'data',
                    'provider' => $this->selectedNetwork,
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

    public function buyDataBundle()
    {
        

        $wallet = Session::get('wallet');
        $this->balance = (int) $wallet['balance'];
        $this->amount = (int) $this->amount;
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

        $body = [
            'network' => $this->selectedNetwork,
            'name' => $this->selectedBundleName,
            'planId' => $this->selectedBundleCode,
            'phone' => $this->phone,
            'allowance' => $this->allowance,
            'validity' => $this->validity,
            'wallet_id' => Session::get('wallet')['wallet_id'],
            'amount' => $this->amount,
            'biller' => $this->biller,
        ];

        $apiEndpoints = new ApiEndpoints();
        $headers = $apiEndpoints->header();
        $response = Http::withHeaders($headers)
            ->withBody(json_encode($body), 'application/json')
            ->post(ApiEndpoints::buyDataBundle());
        if ($response->successful()) {
            $this->refreshWalletSession();

            $info = $response->json()['message'];
            Session::flash('success', $info);
            return redirect()->to('/data');
        }
        info($response->json()['message']);
        Session::flash('error', $response->json()['message']);
        return redirect()->to('/data');
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
    public function render()
    {
        return view('livewire.data.buy-data-form');
    }
}
