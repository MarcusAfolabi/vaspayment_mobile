@extends('layouts.app')
@section('title', '503 - Currently under maintainance')
@section('main')

<section class="section-b-space">
    <div class="custom-container">
        <div class="empty-page">
            <img class="img-fluid" src="{{ asset('assets/images/svg/no-internet.svg') }}" alt="503 - Currently under maintainance" />
            <h2 class="dark-text fw-semibold mt-3">Oops! Currently under maintainance</h2>
            <h3 class="d-block fw-normal light-text text-center mt-2">Please check back later.</h3>
        </div>
    </div>
</section>
@endsection