@extends('layouts.app')
@section('title', 'Virtual Account')
@section('main')
<x-virtual_header />
@livewire('virtual_account')
@livewire('virtual-funding-transactions')
{{-- <x-latest_transactions /> --}}
<br>
@endsection