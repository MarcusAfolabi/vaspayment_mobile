@extends('layouts.app')
@section('title', 'My Settings')
@section('main')
<x-header />
<section class="section-b-space">
    @livewire('dashboard.user.settings')
    <section class="panel-space"></section>
</section>
@endsection