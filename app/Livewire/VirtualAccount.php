<?php

namespace App\Livewire;

use Livewire\Component;
use App\Services\ApiEndpoints;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;

class VirtualAccount extends Component
{

    public $accounts;
    public $submit_nin;
    public $cacheKey = 'virtual_accounts';

    public function mount()
    {
        if (Session::has('user_token')) {
            $user = Session::get("user_data");
            if ($user['nin']) {
                $this->submit_nin = false;
                try {
                    // Check if the data is cached
                    if (Cache::has($this->cacheKey)) {
                        $this->accounts = Cache::get($this->cacheKey);
                    } else {
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
                            // Cache the response
                            Cache::put($this->cacheKey, $this->accounts, now()->addYear(1));
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
        return view('livewire.virtual-account');
    }
}
