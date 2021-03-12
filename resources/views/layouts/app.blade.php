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
    <link rel="stylesheet" href="{{ asset('/assets/libs/highlightjs/styles/vs2015.css')}}"/>

    <link rel="stylesheet" id="stylesheetLight" href="{{ asset('/assets/css/theme.min.css')}}">

    @livewireStyles
</head>
<body>

<div id="app">
    <x-navbar></x-navbar>
</div>

<main class="py-4 thead-dark">
    @yield('content')
</main>
<script src="{{asset('/assets/libs/jquery/dist//jquery.min.js')}}"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/list.js/2.3.1/list.min.js"></script>
@livewireScripts
@yield('js')
</body>

</html>
