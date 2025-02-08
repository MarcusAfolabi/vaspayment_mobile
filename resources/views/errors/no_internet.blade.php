@extends('layouts.app')
@section('title', 'No Internet Connection')
@section('main')


<section class="section-b-space">
    <div class="custom-container">
        <div class="empty-page">
            <img class="img-fluid" src="{{ asset('assets/images/svg/no-internet.svg') }}" alt="404 - Page Not Found" />
            <h2 class="dark-text fw-semibold mt-3">Oops! Your internet connection is lost</h2>
            <h3 class="d-block fw-normal light-text text-center mt-2">Please check connection and try again.</h3>
        </div>
    </div>
</section>
@endsection