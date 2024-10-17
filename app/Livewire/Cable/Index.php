<?php

namespace App\Livewire\Cable;

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
        $this->getCableTransaction();
    }
    public function getCableTransaction()
    {
        $body = [
            'user_id' => $this->userId,
            'type' => 'Cable',

        ];
        $apiEndpoints = new ApiEndpoints();
        $headers = $apiEndpoints->header();
        $response = Http::withHeaders($headers)
            ->withBody(json_encode($body), 'application/json')
            ->post(ApiEndpoints::Transactions());
            // dd($response->json());
        if ($response->successful()) {
            $this->transactions = $response->json()['data'] ?? [];
            $this->total = $response->json()['total'] ?? [];
        } else {
            Session::flash('error', $response->json()['message']);
            $this->addError('error', $response->json()['message']);
        }
    }
    public $total;
    public function render()
    {
        return view('livewire.cable.index');
    }
}
