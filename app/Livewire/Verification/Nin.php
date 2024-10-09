<?php

namespace App\Livewire\Verification;

use Livewire\Component;
use App\Services\ApiEndpoints;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class Nin extends Component
{
    public $nin;
    public $wallet_id;

    protected $rules = [
        'nin' => 'required|digits:11',
    ];
    public function mount()
    {
        $get = Session::get('wallet');
        if ($get) {
            $this->wallet_id = $get['id'];
        }
    }
    public function verifyNIN()
    {
        $this->validate();
        try {
            $body = [
                'nin' => $this->nin,
                'wallet' => $this->wallet_id,
            ];
            $apiEndpoints = new ApiEndpoints();
            $headers = $apiEndpoints->header();
            // dd($headers);
            $response = Http::withHeaders($headers)
                ->withBody(json_encode($body), 'application/json')
                ->post(ApiEndpoints::verifyNIN());
            dd($response);
        } catch (\Throwable $th) {
            Log::info($th->getMessage());
            $this->addError('nin', 'NIN verification failed. Please try again with correct NIN detail');
        }
    }

    public function render()
    {
        return view('livewire.verification.nin');
    }
}
