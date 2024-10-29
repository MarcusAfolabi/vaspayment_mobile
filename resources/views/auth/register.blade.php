@extends('layouts.app')
@section('title', 'Register')
@section('main')
<div class="auth-header">
    <a wire:navigate href="/"> <i class="back-btn" data-feather="arrow-left"></i> </a>
    <img class="img-fluid img" src="{{ asset('assets/images/authentication/6.svg') }}" alt="register with vaspayment" />
    <div class="auth-content">
        <div x-data="{ greeting: '' }" x-init="greeting = getGreeting()">
            <h2 x-text="greeting + ', Champ'"></h2>
            <script>
                function getGreeting() {
                    let currentTime = new Date();
                    let currentHour = currentTime.getHours();

                    if (currentHour >= 5 && currentHour < 12) {
                        return 'Good morning';
                    } else if (currentHour >= 12 && currentHour < 18) {
                        return 'Good afternoon';
                    } else {
                        return 'Good evening';
                    }
                }
            </script>
            <h4 class="p-0">Welcome to VASPAYMENT</h4>
        </div>
    </div>
</div>
@livewire('auth.register')
@endsection