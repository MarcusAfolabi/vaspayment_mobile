@extends('layouts.app')
@section('title', '500 - Internal Service Error')
@section('main')
<x-header />

<section class="section-b-space">
    <div class="custom-container">
        <div class="empty-page">
            <img class="img-fluid" src="{{ asset('assets/images/svg/no-internet.svg') }}" alt="500 - No Internet Service" />
            <h2 class="dark-text fw-semibold mt-3">Oops! Internal Service Error</h2>
            <h3 class="d-block fw-normal light-text text-center mt-2">Somethings occurred unexpectedly</h3>
        </div>
    </div>
</section>
@endsection