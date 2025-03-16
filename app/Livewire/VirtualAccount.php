<?php

namespace App\Livewire;

use Livewire\Component;
use App\Services\ApiEndpoints;
use Illuminate\Support\Facades\DB; 
use Illuminate\Support\Facades\Http; 
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
        //fetch the user virtual account
        $this->virtualAccount = DB::table("virtual_accounts")
        ->where('user_id', $this->user['id'] ?? null)
        ->first();

        if (!$this->virtualAccount) {
            $this->verifyBVN();
        }

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
        $this->bvn = str_pad(mt_rand(0, 99999999999), 11, '0', STR_PAD_LEFT);
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
