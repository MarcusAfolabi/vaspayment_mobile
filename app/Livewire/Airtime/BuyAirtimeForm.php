<?php

namespace App\Livewire\Airtime;

use Livewire\Component;
use App\Services\ApiEndpoints;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class BuyAirtimeForm extends Component
{
    public $networkProvider;
    public $amount;
    public $phone;
    public $userPhone;
    public $saveBeneficiary = false;

    protected $rules = [
        'networkProvider' => 'required|string',
        'phone' => 'required|numeric|regex:/^\d{11}$/',
        'amount' => 'required|numeric|regex:/^[1-9]\d*$/|between:5,1000',
        'saveBeneficiary' => 'sometimes|boolean',
        'beneficiaryName' => 'sometimes|string',
    ];

    public function mount()
    {
        $user = Session::get('user');
        $this->userPhone = $user['phone'];
    }

    public $balance;
    public function BuyAirtime()
    {
        $this->validate();
        $this->balance = (int) Session::get('wallet')['balance'];
        $this->balance = number_format(Session::get('wallet')['balance'], 0, '.', '');
        $amount = $this->amount;

        if ($this->balance >= $amount) {
            
            $body = [
                'network' => $this->networkProvider,
                'wallet_id' => Session::get('wallet')['wallet_id'],
                'amount' => $this->amount,
                'phone' => $this->phone,
                'saveBeneficiary' => $this->saveBeneficiary,
            ];
            $apiEndpoints = new ApiEndpoints();
            $headers = $apiEndpoints->header();
            $response = Http::withHeaders($headers)
            ->withBody(json_encode($body), 'application/json')
            ->post(ApiEndpoints::buyLocalAirtime());
            dd($response->json());
            if ($response->successful()) {
                $info = $response->json()['message'];
                Session::flash('success', $info);
                $this->redirect('/airtime', navigate:true);
            }
            // info($response->json()['message']);
            Session::flash('error', $response->json()['message']);
            $this->redirect('/airtime', navigate: true);

            
        } else {
            $this->addError('response', 'You have insufficient funds');
        }
        Session::flash('message', 'Airtime purchase successful!');
    }

    public function render()
    {
        return view('livewire.airtime.buy-airtime-form');
    }
}
