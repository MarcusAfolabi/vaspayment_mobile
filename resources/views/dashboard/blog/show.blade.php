@extends('layouts.app')
@section('title', ucwords(str_replace('_', ' ', $slug))) 
@section('main')
<x-header />
@livewire('dashboard.blog.show', ['slug' => $slug])
<section class="panel-space"></section>
@endsection