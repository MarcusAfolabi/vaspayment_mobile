<?php

namespace App\Livewire\Airtime;

use Livewire\Component;
use App\Services\ApiEndpoints;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class Index extends Component
{
    public $transactions = [];
    public $userId;
    public $userName;
    public function mount()
    {
        $this->userId = Session::get("user")['id'];
        $this->userName = Session::get("user")['name'];
        $this->getAirtimeTransaction();
    }
    public function getAirtimeTransaction()
    {
        $body = [
            'user_id' => $this->userId,
            'type' => 'Airtime',

        ];
        $apiEndpoints = new ApiEndpoints();
        $headers = $apiEndpoints->header();
        $response = Http::withHeaders($headers)
            ->withBody(json_encode($body), 'application/json')
            ->post(ApiEndpoints::Transactions());
        if ($response->successful()) {
            $this->transactions = $response->json()['data'] ?? [];
            $this->total = $response->json()['total'] ?? [];
        } else {
            $this->addError('error', 'Unable to fetch your aurtime transacction');
        }
    }
    public $total;


    public function render()
    {
        return view('livewire.airtime.index');
    }
}
