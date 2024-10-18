@extends('layouts.app')
@section('title', 'Financial Insight')
@section('main')
<x-header /> 
@livewire('dashboard.blog.index')
<section class="panel-space"></section>
@endsection