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

    public $transactions;
    public $nin;
    public $bvn;
    public $user;
    public $create_virtual_account_form = false;
    public $virtualAccount;


    public function mount()
    {
        $this->user = Session::get("user");
        $user = $this->user;
        
        $this->virtualAccount = Session::get("virtualAccount");    
        if ($this->virtualAccount === []) {
            $this->addError('bvn', 'Enter your BVN to create your virtual account');
            $this->create_virtual_account_form = true;
        } else {
            $this->fundingTransactions();
            $this->addError('bvn', 'Fund your wallet with any of this account number');
        }
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
            $this->transactions = $response->json()['data'];
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
