@extends('layouts.app')
@section('main')
<div class="auth-header">
    <a wire:navigate href="/"> <i class="back-btn" data-feather="arrow-left"></i> </a>
    <img class="img-fluid img" src="{{ asset('assets/images/authentication/6.svg') }}" alt="login to vaspayment" />
    <div class="auth-content">
        <div>
            <h2>Forget your password</h2>
            <h4 class="p-0">Don't worry !</h4>
        </div>
    </div>
</div>
@livewire('auth.forget-password')
@endsection