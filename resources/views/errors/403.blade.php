@extends('layouts.app')
@section('title', '403 - Unauthorization action')
@section('main')


<section class="section-b-space">
    <div class="custom-container">
        <div class="empty-page">
            <img class="img-fluid" src="{{ asset('assets/images/svg/no-internet.svg') }}" alt="403 - Unauthorization action" />
            <h2 class="dark-text fw-semibold mt-3">Oops! Unauthorization action</h2>
        </div>
    </div>
</section>
@endsection