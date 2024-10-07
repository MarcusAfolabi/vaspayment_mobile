@extends('layouts.app')
@section('title', 'Welcome')
@section('main')
    <x-header />
    @livewire('balance-card')
    <x-quick_link />
    <x-other_services />
    <x-ads_banner />
    <x-latest_transactions />
    <br>
@endsection
