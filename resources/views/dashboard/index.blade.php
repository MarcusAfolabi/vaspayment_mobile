@extends('layouts.app')
@section('title', 'Welcome')
@section('main')
    <x-header />
    @livewire('balance-card')
    <x-quick_link />
    <!-- <x-slider /> -->
    <x-ads_banner />
    @livewire('transactions.index')
    <br>
@endsection
