@extends('layouts.app')
@section('title', '500 - Something unexpected happened')
@section('main')

<section class="section-b-space mb-4">
    <div class="custom-container">
        <div class="empty-page">
            <img class="img-fluid" src="{{ asset('assets/images/svg/no-internet.svg') }}" alt="500 - No Internet Service" />
            <h2 class="dark-text fw-semibold mt-3">Oops! @yield('title')</h2>
            <h3 class="d-block fw-normal light-text text-center mt-4 mb-4">We are unable to process your request at this time. Please try again laer</h3>
        </div>
    </div>
</section>
@endsection