<?php

namespace App\Livewire\Menu;

use Livewire\Component;
use Illuminate\Support\Facades\Session;

class SideBar extends Component
{
    public $menuItems;
    public $balance = 0;
    public $commission = 0;
    public $bonus = 0;
    public $logo = 'https://vaspayment.com/logo_web.png';
    public function mount()
    {
       if (Session::has('user_token')) {
            $userWallet = Session::get("user_wallet");
            $userBonus = Session::get("user_bonus");
            $this->balance = $userWallet["balance"] ?? '0.00';
            $this->commission = $userWallet["commission"] ?? '0.00';
            $this->bonus = $userBonus['bonus'] ?? '0.00';
        }
        $this->menuItems = [
            ["label" => "Home", "url" => "/", "icon" => "home"],
            ["label" => "All Transactions", "url" => "/transactions", "icon" => "credit-card"],
            ["label" => "Airtime", "url" => "/airtime", "icon" => "smartphone"],
            ["label" => "Data", "url" => "/data", "icon" => "database"],
            ["label" => "Cable", "url" => "/cable", "icon" => "tv"],
            ["label" => "Electricity", "url" => "/electricity", "icon" => "zap"],
            ["label" => "WAEC Card", "url" => "/wace", "icon" => "book"],
            ["label" => "Recharge Card", "url" => "/recharge-card", "icon" => "phone"],
            ["label" => "Profile", "url" => "/profile", "icon" => "user"],
            ["label" => "Logout", "url" => "/logout", "icon" => "log-out"],
        ];
    }
    public function render()
    {
        return view('livewire.menu.side-bar');
    }
}
