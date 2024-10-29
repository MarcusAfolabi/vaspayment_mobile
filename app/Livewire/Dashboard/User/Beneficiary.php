<?php

namespace App\Livewire\Dashboard\User;

use Livewire\Component;
use App\Services\ApiEndpoints;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class Beneficiary extends Component
{
    public $beneficaries = [];

    public function mount()
    {
        $apiEndpoints = new ApiEndpoints();
        $headers = $apiEndpoints->header();
        $response = Http::withHeaders($headers)
            ->post($apiEndpoints::getBeneficiary());

        if ($response->successful()) {
            $this->beneficaries = [];

            foreach ($response->json()['data'] as $beneficiary) {
                $beneficiary['list'] = json_decode($beneficiary['list'], true); 
                $this->beneficaries[] = $beneficiary;
            }
        }
    }

    public $beneficiaryName;
    public $type;
    public function delete($beneficiaryName, $type)
    {
        $this->beneficiaryName = $beneficiaryName;
        $this->type = $type;
        $body = [
            'beneficiaryUuid' => $this->beneficiaryName,
            'type' => $this->type,
        ];
        $apiEndpoints = new ApiEndpoints();
        $headers = $apiEndpoints->header();
        $response = Http::withHeaders($headers)
            ->withBody(json_encode($body), 'application/json')
            ->post(ApiEndpoints::updateBenficiary());
        if ($response->successful()) {
            $this->mount();
            $info = $response->json()['message'];
            Session::flash('success', $info);
        }

    }


    public function render()
    {
        return view('livewire.dashboard.user.beneficiary');
    }
}
