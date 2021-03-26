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

    <link href="{{ asset('/assets/fonts/feather.css')}}" rel="stylesheet" />


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

<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>

<script src="https://unpkg.com/feather-icons"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js" integrity="sha384-KsvD1yqQ1/1+IA7gi3P0tyJcT3vR+NdBTt13hSJ2lnve8agRGXTTyNaBYmCR/Nwi" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js" integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous"></script>
@livewireScripts
@yield('js')
</body>

</html>
