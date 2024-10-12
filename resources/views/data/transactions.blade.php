@extends('layouts.app')
@section('title', 'Buy Data Bundle')
@section('main')
<x-virtual_header />
@livewire('data.transactions')
<br>
@endsection