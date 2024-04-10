<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Session;

class BalanceCard extends Component
{
    public $balance = 0;
    public $commission = 0;
    public $bonus = 0;

    public function mount()
    {
        if (Session::has('user_token')) {
            $userWallet = Session::get("user_wallet");
            $userBonus = Session::get("user_bonus");
            $this->balance = $userWallet["balance"];
            $this->commission = $userWallet["commission"];
            $this->bonus = $userBonus['bonus'] ?? '0';
        }
    }
    public function render()
    {
        return view('livewire.balance-card');
    }
}
