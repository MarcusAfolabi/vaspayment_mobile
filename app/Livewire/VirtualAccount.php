<?php

namespace App\Livewire;

use Livewire\Component;
use App\Services\ApiEndpoints;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;

class VirtualAccount extends Component
{

    public $transactions;
    public $nin;
    public $bvn;
    public $name;
    public $lastname;
    public $phone;
    public $email;
    public $user;
    public $create_virtual_account_form = false;
    public $virtualAccount;


    public function mount()
    {
        $this->user = Session::get("user");
        $this->virtualAccount = Cache::remember('virtual_account_' . $this->user['id'], 86400, function () {
            return DB::table("virtual_accounts")->where('user_id', $this->user['id'])->first();
        });
        $this->fundingTransactions();
        Session::flash('success', 'Fund your wallet with any of these account numbers');
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

 
    public function render()
    {

        return view('livewire.virtual-account');
    }
}
