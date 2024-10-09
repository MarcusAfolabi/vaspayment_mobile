<?php

namespace App\Livewire\Transactions;

use Livewire\Component;
use App\Services\ApiEndpoints;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class Index extends Component
{
    public $userId;
    public $transactions = [];
    public function mount()
    {
        $this->userId = Session::get('user')['id'];
        $this->getUserTransaction();
    }
    public function getUserTransaction()
    {
        $body = [
            'user_id' => $this->userId,
        ];
        $apiEndpoints = new ApiEndpoints();
        $headers = $apiEndpoints->header();
        $response = Http::withHeaders($headers)
            ->withBody(json_encode($body), 'application/json')
            ->post(ApiEndpoints::userTransactions());

            // dd($response->json());
        if ($response->successful()) {
            $this->transactions = $response->json()['data'];
        } else {
            $this->addError('error', 'Unable to fetch your virtual account');
        }
    }
    public function render()
    {
        return view('livewire.transactions.index');
    }
}
