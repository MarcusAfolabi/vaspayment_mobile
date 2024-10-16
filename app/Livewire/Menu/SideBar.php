<?php

namespace App\Livewire\Menu;

use Livewire\Component;
use Illuminate\Support\Facades\Session;

class SideBar extends Component
{
    public $menuItems;
    public $name;
    public $balance = 0; 
    public function mount()
    {
        $user = Session::get('user');
        $this->name = $user['name'];
        $userWallet = Session::get("wallet");
        $this->balance = $userWallet["balance"] ?? '0.00'; 

        $this->menuItems = [
            ["label" => "Home", "url" => "/", "icon" => asset('assets/feather/home.svg')],
            ["label" => "All Transactions", "url" => "/all-transactions", "icon" => asset('assets/feather/credit-card.svg')],
            ["label" => "Airtime", "url" => "/airtime", "icon" => asset('assets/feather/smartphone.svg')],
            ["label" => "Data", "url" => "/data", "icon" => asset('assets/feather/wifi.svg')],
            ["label" => "Cable", "url" => "/cable", "icon" => asset('assets/feather/tv.svg')],
            ["label" => "Electricity", "url" => "/power", "icon" => asset('assets/feather/zap.svg')],
            // ["label" => "WAEC Card", "url" => "/wace", "icon" => asset('assets/feather/book.svg')],
            ["label" => "Logout", "url" => "/logout", "icon" => asset('assets/feather/log-out.svg')],
        ];
    }
    public function render()
    {
        return view('livewire.menu.side-bar');
    }
}
