@extends('layouts.app')
@section('title', 'All power transactions')
@section('main')
<x-header />
@livewire('power.transactions')
<br>
@endsection