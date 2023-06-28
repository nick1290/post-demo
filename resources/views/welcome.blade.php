@extends('layouts.master')
@section('styles')
@endsection
@section('content')
    @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @livewire('post')
@endsection
@section('scripts')
@endsection
