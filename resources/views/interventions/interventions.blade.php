@extends('layouts.app')

@section('content')
    <div class="mt-4">
        <livewire:interventions-list/>
    </div>
@endsection
@section('js')
    <x-alert-success-js></x-alert-success-js>
@endsection
