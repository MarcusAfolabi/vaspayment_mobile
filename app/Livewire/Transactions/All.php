<?php

namespace App\Livewire\Transactions;

use Livewire\Component;
use App\Services\ApiEndpoints;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class All extends Component
{
    public $userId;
    public $search;
    public $transactions = [];
    public $userName;
    public function mount()
    {
        $this->userId = Session::get('user')['id'];
        $this->userName = Session::get('user')['name'];
        $this->getUserTransaction();
    }
    public function getUserTransaction()
    {
        $body = [
            'user_id' => $this->userId,
            'search' => $this->search,
        ];
        $apiEndpoints = new ApiEndpoints();
        $headers = $apiEndpoints->header();
        $response = Http::withHeaders($headers)
            ->withBody(json_encode($body), 'application/json')
            ->post(ApiEndpoints::userTransactions());
        if ($response->successful()) {
            $this->transactions = $response->json()['data'];
        } else {
            $this->addError('error', 'Unable to fetch your virtual account');
        }
    }

    public function render()
    {
        return view('livewire.transactions.all');
    }
}
