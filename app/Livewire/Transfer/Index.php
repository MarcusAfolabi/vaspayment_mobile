<?php

namespace App\Livewire\Transfer;

use Livewire\Component;
use App\Services\ApiEndpoints;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class Index extends Component
{
    public $balance = 0;
    public $commission = 0;
    public $bonus = 0;
    public $inputAmount;
    public $selectedSource;
    public $user;

    public function mount()
    {
        $this->user = Session::get("user");
        $userWallet = Session::get("wallet");
        $userBonus = Session::get("bonus");
        $this->balance = $userWallet["balance"] ?? '0';
        $this->commission = $userWallet["commission"] ?? '0';
        $this->bonus = $userBonus['bonus'] ?? '0';
    }
    public $from;

    public function transfer()
    {
        // Validate input values
        $this->validate([
            'from' => 'required',
            'inputAmount' => 'required|numeric|min:1',
        ]);


        $explode = explode('/', $this->from);
        if (count($explode) === 2) {
            $available = floatval($explode[0]);
            $type = $explode[1];
            $inputAmountFloat = floatval($this->inputAmount);
            if ($inputAmountFloat > $available) {
                Session::flash('error', 'You can not withdraw more than your available balance.');
                return redirect('/transfer');
            }
            $body = [
                'amount' => $available,
                'type' => $type,
                'withdraw' => $inputAmountFloat,
            ];
            $apiEndpoints = new ApiEndpoints();
            $headers = $apiEndpoints->header();
            $response = Http::withHeaders($headers)
            ->withBody(json_encode($body), 'application/json')
            ->post(ApiEndpoints::commissionTransfer());
            
            if ($response->successful()) {
                $this->refreshWalletSession();
                Session::flash('success',  $response->json()['message']);
                return redirect('/transfer');
            } else {
                Session::flash('error',  $response->json()['message']);
                return redirect('/transfer');
            }
        } else {
            $this->addError('selectedSource', 'Invalid format for selected source.');
        }
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
            return $wallet;
        } else {
            return null;
        }
    }
    public function render()
    {
        return view('livewire.transfer.index');
    }
}
