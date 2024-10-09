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
        if (Session::has('token')) {
            $userWallet = Session::get("wallet");
            
            $userBonus = Session::get("bonus");
            $this->balance = $userWallet["balance"] ?? '0';
            $this->commission = $userWallet["commission"] ?? '0';
            $this->bonus = $userBonus['bonus'] ?? '0';
        }
    }
    public function render()
    {
        return view('livewire.balance-card');
    }
}
