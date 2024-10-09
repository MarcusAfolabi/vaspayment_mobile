<?php

namespace App\Livewire;

use Livewire\Component;
use App\Services\ApiEndpoints;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;


class VirtualFundingTransactions extends Component
{
    public $virtual_transactions;
    public $submit_nin;
    public $cacheKey = 'virtual_transactions';

    public function mount()
    {
        if (Session::has('token')) {
            $user = Session::get("user");
            if ($user['nin']) {
                try {
                    // Check if the data is cached
                    if (Cache::has($this->cacheKey)) {
                        $this->virtual_transactions = Cache::get($this->cacheKey);
                    } else {
                        $body = [
                            'wallet_id' => $user['id'],
                        ];
                        $apiEndpoints = new ApiEndpoints();
                        $headers = $apiEndpoints->header();
                        $response = Http::withHeaders($headers)
                            ->withBody(json_encode($body), 'application/json')
                            ->get(ApiEndpoints::VirtualFundingTransactions());
                        info($response->json()['message']);
                        if ($response->successful()) {
                            $this->virtual_transactions = $response->json()['message'];
                            // Cache the response
                            Cache::put($this->cacheKey, $this->virtual_transactions, now()->addMinute(3));
                        } else {
                            $this->addError('error', 'Unable to fetch your virtual account');
                        }
                    }
                } catch (\Throwable $e) {
                    Log::error($e->getMessage());
                    $this->addError('error', 'Internet connection error occurred. Pls try again later');
                }
            } else {
                $this->submit_nin = true;
            }
        }
    }

    public function render()
    {
        return view('livewire.virtual-funding-transactions');
    }
}
