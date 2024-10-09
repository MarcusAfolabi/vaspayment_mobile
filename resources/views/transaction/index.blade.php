@extends('layouts.app')
@section('title', 'All transactions')
@section('main')
<x-header /> 
@livewire('transactions.all')
@endsection