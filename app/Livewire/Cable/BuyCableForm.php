<?php

namespace App\Livewire\Cable;

use Livewire\Component;
use App\Services\ApiEndpoints;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class BuyCableForm extends Component
{
    public $networkProvider;
    public $amount;
    public $phone;
    public $user;
    public $userPhone;
    public $saveBeneficiary = false;
    public $beneficiaryName;

    public $resellerPrice; 
    public $errorMessage = null; // For holding error messages
    public $isButtonDisabled = false; // To disable the button
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
            'product_type' => 'airtime',
            'list' => json_encode([
                [
                    'type' => 'airtime',
                    'network' => $this->network,
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
            ->post(ApiEndpoints::dataNetworks());
        if ($response->successful()) {
            $this->networks = $response->json()['data'] ?? [];
            $this->biller = $response->json()['biller_name'] ?? [];
        } else {
            $this->addError('beneficiary', $response->json()['message']);
        }
    }

    public function render()
    {
        return view('livewire.cable.buy-cable-form');
    }
}
