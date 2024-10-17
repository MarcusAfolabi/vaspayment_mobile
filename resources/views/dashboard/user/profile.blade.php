@extends('layouts.app')
@section('title', 'Profile')
@section('main')
<x-header />

@php
$user = session()->get('user');
$name = $user['name'];
$photo = $user['profile_photo_path'];
$phone = $user['phone'];
@endphp

<section class="section-b-space">
    <div class="custom-container">

        <div class="profile-section">
            <div class="profile-banner">
                <div class="profile-image">
                    <img class="img-fluid profile-pic" src="{{ $photo }}" alt="p3" />
                </div>
            </div>
            <h2>{{ $name }}</h2>
            <h5>{{ $phone }}</h5>
        </div>

        <ul class="profile-list">
            <li>
                <a wire:navigate href="{{ route('user.account') }}" class="profile-box">
                    <div class="profile-img">
                        <img class="" src="{{ asset('assets/feather/user.svg') }}" />
                    </div>
                    <div class="profile-details">
                        <h4>My Account</h4>
                        <img class="img-fluid arrow" src="{{ asset('assets/feather/arrow-right.svg') }}" alt="arrow" />
                    </div>
                </a>
            </li>

            <li>
                <a wire:navigate href="{{ route('virtual.account') }}" class="profile-box">
                    <div class="profile-img">
                        <img class="" src="{{ asset('assets/feather/credit-card.svg') }}" />
                    </div>
                    <div class="profile-details">
                        <h4>My Virtual Account</h4>
                        <img class="img-fluid arrow" src="{{ asset('assets/feather/arrow-right.svg') }}" alt="arrow" />
                    </div>
                </a>
            </li>
            
            <li>
                <a wire:navigate href="{{ route('user.beneficiary') }}" class="profile-box">
                    <div class="profile-img">
                        <img class="" src="{{ asset('assets/feather/users.svg') }}" />
                    </div>
                    <div class="profile-details">
                        <h4>My Beneficiaries</h4>
                        <img class="img-fluid arrow" src="{{ asset('assets/feather/arrow-right.svg') }}" alt="arrow" />
                    </div>
                </a>
            </li>
            <li>
                <a wire:navigate href="{{ route('user.password') }}" class="profile-box">
                    <div class="profile-img">
                        <img class="" src="{{ asset('assets/feather/settings.svg') }}" />
                    </div>
                    <div class="profile-details">
                        <h4>Change Password</h4>
                        <img class="img-fluid arrow" src="{{ asset('assets/feather/arrow-right.svg') }}" alt="arrow" />
                    </div>
                </a>
            </li>
            <li>
                <a wire:navigate href="{{ route('user.settings') }}" class="profile-box">
                    <div class="profile-img">
                        <img class="" src="{{ asset('assets/feather/lock.svg') }}" />
                    </div>
                    <div class="profile-details">
                        <h4>Settings</h4>
                        <img class="img-fluid arrow" src="{{ asset('assets/feather/arrow-right.svg') }}" alt="arrow" />
                    </div>
                </a>
            </li>

            <li>
                <a wire:navigate href="{{ route('user.helpdesk') }}" class="profile-box">
                    <div class="profile-img">
                        <img class="" src="{{ asset('assets/feather/help-circle.svg') }}" />
                    </div>
                    <div class="profile-details">
                        <h4>Help Center</h4>
                        <img class="img-fluid arrow" src="{{ asset('assets/feather/arrow-right.svg') }}" alt="arrow" />
                    </div>
                </a>
            </li>
            <li>
                <a href="/logout" class="profile-box">
                    <div class="profile-img">
                        <img class="" src="{{ asset('assets/feather/log-out.svg') }}" />
                    </div>
                    <div class="profile-details">
                        <h4>Log Out</h4>
                    </div>
                </a>
            </li>
        </ul>

    </div>
    <section class="panel-space"></section>
</section>
@endsection