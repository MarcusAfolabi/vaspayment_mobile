@extends('layouts.app')
@section('title', 'My beneficiaries')
@section('main')
<x-header />
<section class="section-b-space">
    @livewire('dashboard.user.beneficiary')
    <section class="panel-space"></section>

</section>
@endsection