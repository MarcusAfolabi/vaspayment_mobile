<?php

namespace App\Livewire;

use Livewire\Component;
use App\Services\ApiEndpoints;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use PDO;

class VirtualAccount extends Component
{

    public $accounts;
    public $bvn;
    public $submit_nin;
    public $cacheKey = 'virtual_accounts';

    public function mount()
    {
        $user = Session::get("user");
        if ($user['bvn']) {
            $this->submit_nin = false;
            try {

                $body = [
                    'user_id' => $user['id'],
                ];

                $apiEndpoints = new ApiEndpoints();
                $headers = $apiEndpoints->header();
                $response = Http::withHeaders($headers)
                    ->withBody(json_encode($body), 'application/json')
                    ->get(ApiEndpoints::virtualAccount());
                if ($response->successful()) {
                    $this->accounts = $response->json()['message'];
                } else {
                    $this->addError('error', 'Unable to fetch your virtual account');
                }
            } catch (\Throwable $e) {
                Log::error($e->getMessage());
                $this->addError('error', 'Internet connection error occurred. Pls try again later');
            }
        } else {
            $this->submit_nin = true;
        }
    }

    public function verifyBVN()
    {
        $user = Session::get('user');
        $wallet = Session::get('wallet');
        $body = [
            'bvn' => $this->bvn,
            'wallet_id' => $wallet['id'],
            'email' => $user['email'],
        ];
        $apiEndpoints = new ApiEndpoints();
        $headers = $apiEndpoints->header();
        $response = Http::withHeaders($headers)
        ->withBody(json_encode($body), 'application/json')
        ->post(ApiEndpoints::createVirtualAccount());
        if ($response->successful()) {
            $this->mount();
            $this->addError('response',  $response->json()['message']);
        } else {
            $this->addError('bvn',  $response->json()['message'] ??  $response->json()['message']['responseMessage']);
        }
    }



    public function render()
    {
        return view('livewire.virtual-account');
    }
}
