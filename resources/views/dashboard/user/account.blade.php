@extends('layouts.app')
@section('title', 'My account')
@section('main')
<x-header /> 
<section class="section-b-space">
    @livewire('dashboard.user.account')
    <section class="panel-space"></section>

</section>
@endsection