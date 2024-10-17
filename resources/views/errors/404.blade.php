@extends('layouts.app')
@section('title', '404 - Page not found')
@section('main')
    <x-header />
    <section class="section-b-space">
        <div class="custom-container">
            <div class="empty-page">
                <img class="img-fluid" src="{{ asset('assets/images/svg/no-internet.svg') }}" alt="404 - Page Not Found" />
                <h2 class="dark-text fw-semibold mt-3">Oops! Page Not Found</h2>
                <h3 class="d-block fw-normal light-text text-center mt-2">Please check your web url & try again
                    later.</h3>
            </div>
        </div>
    </section>
@endsection
