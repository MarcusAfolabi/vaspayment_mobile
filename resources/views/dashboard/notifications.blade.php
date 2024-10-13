@extends('layouts.app')
@section('title', 'Notifications')
@section('main')
<x-header />
@livewire('notification.index')
@endsection