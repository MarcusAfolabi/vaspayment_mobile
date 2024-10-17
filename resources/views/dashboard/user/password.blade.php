@extends('layouts.app')
@section('title', 'My Password')
@section('main')
<x-header />
<section class="section-b-space">
    @livewire('dashboard.user.password')
    <section class="panel-space"></section>

</section>
@endsection