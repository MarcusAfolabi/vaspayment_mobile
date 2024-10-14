@extends('layouts.app')
@section('title', 'All data transactions')
@section('main')
<x-header />
@livewire('data.transactions')
<br>
@endsection