<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>ERP - Stage</title>

    <link rel="stylesheet" href="{{ asset('/assets/fonts/feather/feather.css')}}"/>
    <link rel="stylesheet" href="{{ asset('/assets/libs/flatpickr/dist/flatpickr.min.css')}}"/>
    <link rel="stylesheet" href="{{ asset('/assets/libs/quill/dist/quill.core.css')}}"/>

    <link rel="stylesheet" id="stylesheetLight" href="{{ asset('/assets/css/theme.min.css')}}">

    <link href='https://api.mapbox.com/mapbox-gl-js/v2.1.1/mapbox-gl.css' rel='stylesheet' />

    <link href="{{ asset('/assets/libs/select2/dist/css/select2.min.css')}}" rel="stylesheet" />

    @livewireStyles
</head>
<body>

<div id="app">
    <x-navbar></x-navbar>
</div>

<main>
    @yield('content')
</main>

<script src="{{asset('/assets/libs/jquery/dist/jquery.min.js')}}"></script>
<script src='https://api.mapbox.com/mapbox-gl-js/v2.1.1/mapbox-gl.js'></script>
<script src="https://unpkg.com/es6-promise@4.2.4/dist/es6-promise.auto.min.js"></script>
<script src="https://unpkg.com/@mapbox/mapbox-sdk/umd/mapbox-sdk.min.js"></script>
<script src="{{asset('/assets/libs/select2/dist/js/select2.min.js')}}"></script>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

@livewireScripts
@yield('js')
</body>

</html>
