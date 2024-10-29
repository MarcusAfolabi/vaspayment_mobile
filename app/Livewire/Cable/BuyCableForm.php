<?php

namespace App\Livewire\Cable;

use Livewire\Component;
use Illuminate\Support\Str;
use App\Services\ApiEndpoints;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class BuyCableForm extends Component
{
    public $saveBeneficiary = false;
    public $beneficiaryName;

    public $resellerPrice;
    public $errorMessage = null; // For holding error messages
    public $isButtonDisabled = false; // To disable the button
    public $smartCardNo;
    public $productsCode;
    public $packagename;
    public $packages;
    public $beneficiaries;
    public $selectedType;
    public $types;

    protected $rules = [
        'type' => 'required|string',
        'smartCardNo' => 'required|string',
        'productsCode' => 'required|string',
        'packagename' => 'required|string',
        'phone' => 'required|numeric|regex:/^\d{11}$/',
        'resellerPrice' => 'required',
        'saveBeneficiary' => 'nullable|boolean',
        'beneficiaryName' => 'nullable|string|required_if:saveBeneficiary,true',
    ];

    public $userPhone;
    public $user;
    public function mount()
    {
        $this->types = [
            ['name' => 'DSTV'],
            ['name' => 'GOTV'],
            ['name' => 'SHOWMAX'],
            ['name' => 'STARTIMES'],
        ];

        $this->user = Session::get('user');
        $this->userPhone = $this->user['phone'];
        if (strpos($this->userPhone, '234') === 0) {
            $this->userPhone = '0' . substr($this->userPhone, 3);
        }
        $this->getCableBeneficiaries();
    }

    public function getCableBeneficiaries()
    {
        $body = [
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
            'product_type' => 'cable',
            'list' => json_encode([
                [
                    'uuid' => (string) Str::uuid(),
                    'type' => 'cable',
                    'provider' => $this->selectedType,
                    'smartCardNo' => $this->smartCardNo,
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



    public function updatedSelectedType()
    {
        $body = [
            'type' => strtolower($this->selectedType),
        ];

        $apiEndpoints = new ApiEndpoints();
        $headers = $apiEndpoints->header();
        $response = Http::withHeaders($headers)
            ->withBody(json_encode($body), 'application/json')
            ->get(ApiEndpoints::getCablePackage());
        if ($response->successful()) {
            $this->reset(['selectedType', 'resellerPrice']);
            $this->packages = $response->json()['data'] ?? [];
        } else {
            $this->addError('beneficiary', $response->json()['message']);
        }
    }
    public $amount;
    public $phone;
    public $code;
    public $name;
    public $period;
    public $selectedPackage;

    public function updatedSelectedPackage()
    {
        if ($this->selectedPackage) {
            $package = explode('/', $this->selectedPackage);
            $this->code = $package[0];
            $this->name = $package[1];
            $this->selectedType = strtoupper($package[2]);
            $this->amount = $package[3];
            $this->period = $package[4];
            $this->resellerPrice = '₦' . number_format($package[3]); // Reseller price
        } else {
            $this->addError('selectedPackage', 'Select your package');
        }
    }

    public $beneficiary;
    public function updatedSmartCardNo()
    {
        try {
            $this->validate([
                'selectedType' => 'required',
                'smartCardNo' => [
                    function ($attribute, $value, $fail) {
                        if ($this->selectedType !== 'SHOWMAX' && empty($value)) {
                            $fail('The smartCardNo field is required for non-SHOWMAX types.');
                        }
                    },
                ],
            ]);
            $body = [
                'type' => $this->selectedType,
                'smartCardNo' => $this->smartCardNo,
            ];
            // dd($body);
            $apiEndpoints = new ApiEndpoints();
            $headers = $apiEndpoints->header();
            $response = Http::withHeaders($headers)
                ->withBody(json_encode($body), 'application/json')
                ->post(ApiEndpoints::queryDecoderNo());

            // dd($response->body());

            if ($response->successful()) {
                $this->customerName = $response->json()['customerName'] ?? [];
            } else {
                $this->addError('smartCardNo', 'Unable to fetch your customer name');
            }
        } catch (\Throwable $th) {
            $this->addError('smartCardNo', $th->getMessage());
        }
    }
    public $customerName;
    public $balance;
    public $disableButton;


    public function buyCableSubscription()
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

        $this->validate([
            'selectedType' => 'required',
            'smartCardNo' => [
                function ($attribute, $value, $fail) {
                    if ($this->selectedType !== 'SHOWMAX' && empty($value)) {
                        $fail('The smartCardNo field is required for non-SHOWMAX types.');
                    }
                },
            ],
            'code' => 'required',
            'name' => 'required',
            'period' => 'required',
            'amount' => 'required',
        ]);
        if ($this->beneficiaryName) {
            $this->saveBeneficiary();
        }


        $body = [
            "type" => $this->selectedType,
            "smartCardNo" => $this->smartCardNo,
            "code" => $this->code,
            "name" => $this->name,
            "period" => $this->period,
            "amount" => $this->amount,
        ];
        $apiEndpoints = new ApiEndpoints();
        $headers = $apiEndpoints->header();
        $response = Http::withHeaders($headers)
            ->withBody(json_encode($body), 'application/json')
            ->post(ApiEndpoints::buyCableSubscription());
        if ($response->successful()) {
            $this->refreshWalletSession();
            $info = $response->json()['message'];
            Session::flash('success', $info);
            return redirect()->to('/cable');
        } else {
            $this->errorMessage = $response->json()['message'];
        }
    }
    public $package;
    public function refreshWalletSession()
    {
        $wallet = DB::table('wallets')->where('user_id', $this->user['id'])->first();

        if ($wallet) {
            Session::put('wallet', [
                'wallet_id' => $wallet->wallet_id,
                'balance' => $wallet->balance,
                'commission' => $wallet->commission,
            ]);
            Log::info('Wallet session refreshed: ', ['wallet_id' => $wallet->wallet_id, 'balance' => $wallet->balance, 'commission' => $wallet->commission]);
            return $wallet;
        } else {
            Log::error('Wallet not found for user ID: ' . $this->user['id']);
            return null;
        }
    }
    public function render()
    {
        return view('livewire.cable.buy-cable-form');
    }
}
