<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>

<head>
    <title>@yield('title')</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ elixir('assets/css/app.css') }}">
    <script src="{{ elixir('js/jquery.js') }}"></script>
    <script src="{{ elixir('js/bootstrap.js') }}"></script>
    <script src="{{ elixir('assets/js/vue.min.js') }}"></script>
    @yield('extra-css-js')
</head>

<body>
@include('layouts.main-compoent.navbar.navbar')

@yield('content')


</body>
</html>
