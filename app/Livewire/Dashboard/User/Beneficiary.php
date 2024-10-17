<?php

namespace App\Livewire\Dashboard\User;

use Livewire\Component;
use App\Services\ApiEndpoints;
use Illuminate\Support\Facades\Http;

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
            // Extracting the beneficiaries and their lists
            $this->beneficaries = [];

            foreach ($response->json()['data'] as $beneficiary) {
                // Decode the list and store it as part of the beneficiary
                $beneficiary['list'] = json_decode($beneficiary['list'], true); // Decode as associative array
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
        info($body);   
        $apiEndpoints = new ApiEndpoints();
        $headers = $apiEndpoints->header();
        $response = Http::withHeaders($headers)
            ->withBody(json_encode($body), 'application/json')
            ->post(ApiEndpoints::updateBenficiary());
            dd($response->json());
        if ($response->successful()) {
            $this->mount();
            $info = $response->json()['message'];
        }

    }


    public function render()
    {
        return view('livewire.dashboard.user.beneficiary');
    }
}
