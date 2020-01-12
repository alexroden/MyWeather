<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('pageTitle', config('app.name'))</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
<div id="app" style="height: 100%">
    @yield('content')
    <modal></modal>
</div>

</body>

<script src="{{ asset('js/app.js') }}" defer></script>

</html>
