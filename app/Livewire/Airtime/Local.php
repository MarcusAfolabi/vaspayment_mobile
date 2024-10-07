<?php

namespace App\Livewire\Airtime;

use Livewire\Component;

class Local extends Component
{
    public $network = [
        "MTN","AIRTEL",
        "GLO", "9MOBILE",
    ];
    public function render()
    {
        return view('livewire.airtime.local');
    }
}
