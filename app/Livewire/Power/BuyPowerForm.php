<?php

namespace App\Livewire\Power;

use Livewire\Component;
use App\Services\ApiEndpoints;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class BuyPowerForm extends Component
{
    public $networkProvider;
    public $networks;
    public $network;
    public $provider;
    public $type;
    public $amount;
    public $phone;
    public $user;
    public $userPhone;
    public $saveBeneficiary = false;
    public $beneficiaryName;

    public $errorMessage = null; // For holding error messages
    public $isButtonDisabled = false; // To disable the button

    public $biller;
    public $balance;
    public $meterno;
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
            'type' => 'cable',
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

    protected function saveBeneficiary()
    {

        $body = [
            'user_id' => $this->user['id'],
            'product_type' => 'electricity',
            'list' => json_encode([
                [
                    'type' => 'electricity',
                    'network' => $this->selectedNetwork,
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

    public function getDataNetwork()
    {

        $apiEndpoints = new ApiEndpoints();
        $headers = $apiEndpoints->header();
        $response = Http::withHeaders($headers)
            ->post(ApiEndpoints::electricityTypes());
        if ($response->successful()) {
            $this->networks = $response->json()['data'] ?? [];
        } else {
            $this->addError('types', $response->json()['message']);
        }
    }

    public $selectedType;
    public function updatedMeterno()
    {
        $this->validate([
            'meterno' => 'required|digits_between:10,13',
            "selectedNetwork" => "required",
            "selectedType" => "required",
        ]);

        $body = [
            'meterNo' => $this->meterno,
            'disco' => $this->selectedNetwork,
            'type' => $this->selectedType,
        ];
        $apiEndpoints = new ApiEndpoints();
        $headers = $apiEndpoints->header();
        $response = Http::withHeaders($headers)
            ->withBody(json_encode($body), 'application/json')
            ->post(ApiEndpoints::queryMeterNo());
        // Decode the API response
        $responseData = $response->json();

        info($responseData);

        if (isset($responseData['status']) && $responseData['status'] === 'success') {
            if (isset($responseData['data']['customerName']) && !empty($responseData['data']['customerName'])) {
                $this->disableButton = false;
                $this->beneficiary = $responseData['data']['customerName'];
            } else {
                $this->disableButton = true;
                $this->addError('meterno', 'You selected the wrong provider. Please try again');
            }
        } elseif (isset($responseData['message']) && !empty($responseData['message'])) {
            $this->disableButton = true;
            $this->addError('meterno', $responseData['message']);
        } else {
            $this->disableButton = true;
            $this->addError('meterno', 'Unexpected response from server.');
        }
    }
    public $responded;
    public $beneficiary;
    public $disableButton = false;


    public function BuyToken()
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
            ->post(ApiEndpoints::buyElectricity());
        if ($response->successful()) {
            $info = $response->json()['message'];
            Session::flash('success', $info);
            return redirect()->to('/power');
        }
        info($response->json()['message']);
        Session::flash('error', $response->json()['message']);
        return redirect()->to('/power');
    }
    public function render()
    {
        return view('livewire.power.buy-power-form');
    }
}
