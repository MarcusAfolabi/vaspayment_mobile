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

        // Check if the virtual account is empty or not set, and fetch it if necessary
        if (empty($this->virtualAccount)) {
            $this->fetchVirtualAccount();
        } else {
            // Show form to create virtual account if needed
            if (empty($this->virtualAccount)) {
                Session::flash('error', 'Enter your BVN to create your virtual account');
                $this->create_virtual_account_form = true;
            } else {
                // If virtual account exists, display funding options
                $this->fundingTransactions();
                Session::flash('success', 'Fund your wallet with any of this account number');
            }
        }
    }

    public function fetchVirtualAccount()
    {
        $userId = Session::get('user')['id'];
        $body = [
            'user_id' => $userId,
        ];
        $apiEndpoints = new ApiEndpoints();
        $headers = $apiEndpoints->header();

        $response = Http::withHeaders($headers)
            ->withBody(json_encode($body), 'application/json')
            ->post(ApiEndpoints::virtualAccount());

        // dd($response->json());
        if ($response->successful()) {
            $virtualAccountData = $response->json()['data'];
            Session::put("virtualAccount", $virtualAccountData);
            $this->virtualAccount = $virtualAccountData;
            // dd($this->virtualAccount);
        } else {
            $this->create_virtual_account_form = true;
            Session::flash('error', $response->json()['message']);
        }
    }


    public function fundingTransactions()
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
        $this->validate([
            'bvn' => 'required|digits:11',
            'lastname' => 'required|string',
        ]);

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
            Session::flash('success',  $response->json()['message']);
            $this->redirect('/virtual-account', navigate: true);
        } else {
            $this->addError('bvn',  $response->json()['message'] ??  $response->json()['message']['responseMessage']);
        }
    }


    public function verifyNIN()
    {
        $user = Session::get('user');
        try {
            $this->validate([
                'nin' => 'required|digits:11',
                'email' => 'required|email',
                'name' => 'required|string',
                'lastname' => 'required|string',
                'phone' => 'required',
            ]);

            $body = [
                'nin' => $this->nin,
                'lastname' => $user['lastname'],
            ];
            $apiEndpoints = new ApiEndpoints();
            $headers = $apiEndpoints->header();
            $response = Http::withHeaders($headers)
                ->withBody(json_encode($body), 'application/json')
                ->post(ApiEndpoints::createBudPayVirtualAccount());
            if ($response->successful()) {
                Session::flash('success',  $response->json()['message']);
                $this->redirect('/virtual-account', navigate: true);
            } else {
                $this->addError('nin',  $response->json()['message'] ??  $response->json()['message']['responseMessage']);
            }
        } catch (\Throwable $th) {
            $this->addError('nin',  $th->getMessage());
        }
    }





    public function render()
    {

        return view('livewire.virtual-account');
    }
}
