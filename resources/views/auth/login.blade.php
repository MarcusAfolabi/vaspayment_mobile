@extends('layouts.app')
@section('main')
    @persist('header')
        <div class="auth-header">
            <a wire:navigate href="/"> <i class="back-btn" data-feather="arrow-left"></i> </a>
            <img class="img-fluid img" src="{{ asset('assets/images/authentication/6.svg') }}" alt="login to vaspayment" />
            <div class="auth-content">
                <div>
                    <h2>Welcome back, Champ</h2>
                    <h4 class="p-0">Enter your credential to continue</h4>
                </div>
            </div>
        </div>
    @endpersist
    @livewire('auth.login')
@endsection
