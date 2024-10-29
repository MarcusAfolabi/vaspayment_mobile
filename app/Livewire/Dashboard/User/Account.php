<?php

namespace App\Livewire\Dashboard\User;

use Livewire\Component;
use App\Services\ApiEndpoints;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class Account extends Component
{
    public $name;
    public $photo;
    public $email;
    public $phone;
    public $referralId;
    public $user;
    public $wallet;

    public function mount()
    {
        $this->user = Session::get('user');
        $this->wallet = Session::get('wallet');
        $this->fillUserData();
    }

    private function fillUserData()
    {
        // Set the properties based on the authenticated user
        $this->name = $this->user['name'];
        $this->lastname = $this->user['lastname'];
        $this->photo = $this->user['profile_photo_path'];
        $this->email = $this->user['email'];
        $this->phone = $this->user['phone'];
        $this->referralId = $this->wallet['wallet_id'];
    }

    #[Validate('required')]
    public $lastname = '';


    public function updated()
    {
        $body = [
            'lastname' => $this->lastname,
        ];

        $apiEndpoints = new ApiEndpoints();
        $headers = $apiEndpoints->header();
        $response = Http::withHeaders($headers)
            ->withBody(json_encode($body), 'application/json')
            ->post($apiEndpoints::updateAccount());
        if ($response->successful()) {
            $this->user = $response->json()['data'];
            Session::put('user', $this->user);
            $this->fillUserData();
            $this->addError('lastname', $response->json()['message']);
        }
    }
    public function render()
    {
        return view('livewire.dashboard.user.account');
    }
}
