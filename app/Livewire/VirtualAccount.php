<?php

namespace App\Livewire;

use Livewire\Component;
use App\Services\ApiEndpoints;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cache;

class VirtualAccount extends Component
{

    public $accounts;
    public $fundingTransactions;
    public $nin;
    public $bvn;
    public $user;
    public $create_virtual_account_form;


    public function mount()
    {
        $this->user = Session::get("user");
        $user = $this->user;
        $this->create_virtual_account_form = false;
        $cacheKey = "virtual_account_" . $user['id'];
        
        $this->accounts = Cache::remember($cacheKey, 60 * 24 * 60, function () use ($user) {
            return $this->fetchVirtualAccountFromAPI($user);
        });
        
        if (empty($this->accounts)) {
            $this->addError('bvn', 'Enter your BVN to create your virtual account');
            $this->create_virtual_account_form = true;
        } else {
            // User already has a virtual account, show funding transactions
            $this->fundingTransactions();
            $this->addError('bvn', 'Fund your wallet with any of this account number');
        }
    }


    private function fetchVirtualAccountFromAPI($user)
    {
        try {
            $body = [
                'user_id' => $user['id'],
            ];

            $apiEndpoints = new ApiEndpoints();
            $headers = $apiEndpoints->header();
            $response = Http::withHeaders($headers)
                ->withBody(json_encode($body), 'application/json')
                ->get(ApiEndpoints::virtualAccount());
            if ($response->successful()) {
                return $response->json()['data'];
            }
        } catch (\Throwable $e) {
            Log::error($e->getMessage());
            $this->addError('error', 'Internet connection error occurred. Please try again later');
            return null;
        }
        return null;
    }

    private function fundingTransactions()
    {
        $body = [
            'user_id' => $this->user['id'],
        ];
        $apiEndpoints = new ApiEndpoints();
        $headers = $apiEndpoints->header();
        $response = Http::withHeaders($headers)
            ->withBody(json_encode($body), 'application/json')
            ->post(ApiEndpoints::VirtualFundingHistory());
        if ($response->successful()) {
            $this->fundingTransactions = $response->json()['data'];
        } else {
            $this->addError('error', 'Unable to fetch your virtual account');
        }
    }

    public function verifyBVN()
    {
        $user = Session::get('user');
        $wallet = Session::get('wallet');
        $body = [
            'bvn' => $this->bvn,
            'wallet_id' => $wallet['id'],
            'email' => $user['email'],
        ];
        $apiEndpoints = new ApiEndpoints();
        $headers = $apiEndpoints->header();
        $response = Http::withHeaders($headers)
            ->withBody(json_encode($body), 'application/json')
            ->post(ApiEndpoints::createMonnifyVirtualAccount());
        if ($response->successful()) {
            $this->addError('bvn',  $response->json()['message']);
            $this->redirect('/virtual-account', navigate: true);
        } else {
            $this->addError('bvn',  $response->json()['message'] ??  $response->json()['message']['responseMessage']);
        }
    }


    public function verifyNIN()
    {
        $user = Session::get('user');
        $wallet = Session::get('wallet');
        $body = [
            'nin' => $this->nin,
            'wallet_id' => $wallet['id'],
            'email' => $user['email'],
            'name' => $user['name'],
            'lastname' => $user['lastname'],
            'phone' => $user['phone'],
        ];
        $apiEndpoints = new ApiEndpoints();
        $headers = $apiEndpoints->header();
        $response = Http::withHeaders($headers)
            ->withBody(json_encode($body), 'application/json')
            ->post(ApiEndpoints::createBudPayVirtualAccount());
        if ($response->successful()) {
            $this->addError('nin',  $response->json()['message']);
            $this->redirect('/virtual-account', navigate: true);
        } else {
            $this->addError('nin',  $response->json()['message'] ??  $response->json()['message']['responseMessage']);
        }
    }



    public function render()
    {

        return view('livewire.virtual-account');
    }
}
