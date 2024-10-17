@extends('layouts.app')
@section('title', 'Welcome')
@section('main')
<x-main_header />
@livewire('balance-card')
<x-quick_link />
<!-- <x-slider /> -->
<x-ads_banner />
@livewire('transactions.index')
<section class="panel-space"></section>
@endsection