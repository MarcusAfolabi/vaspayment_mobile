<?php

namespace App\Livewire\Power;

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
        $this->getPowerTransaction();
    }
    public function getPowerTransaction()
    {
        $body = [
            'user_id' => $this->userId,
            'type' => 'Electricity',
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
            $this->addError('error', 'Unable to fetch your electricity transaction');
        }
    }
    public $total;
    public function render()
    {
        return view('livewire.power.index');
    }
}
