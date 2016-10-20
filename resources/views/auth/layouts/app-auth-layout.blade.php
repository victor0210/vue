<!DOCTYPE html>
<html>

<head>
    <title>@yield('title')</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ elixir('assets/css/app.css') }}">
    <link rel="stylesheet" href="{{ elixir('assets/css/navbar.css') }}">
    <script src="{{ elixir('js/jquery.js') }}"></script>
    <script src="{{ elixir('js/bootstrap.js') }}"></script>
    @yield('extra-css-js')
    <style>
        #auth-temp {
            background-size: contain;
            -webkit-background-size: contain;
            background: url('{{ elixir("images/4k2.jpg") }}') no-repeat left;
            transition: 100s linear;
        }

        .affix {
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.6);
            z-index: -1
        }

        .container {
            padding-top: 10%;
        }

        .panel-default {
            border: none;
            border-radius: 0;
        }

        .panel-default > .panel-heading {
            background-color: #3c3c3c;
            color: #fff;
            font-size: 1.2em;
            border: none;
            border-radius: 0;
        }
    </style>
</head>

<body id="auth-temp">

<div class="row">
    <nav class="navbar navbar-fixed-top" role="navigation">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav navbar-menu">
                <li name="tab1"><a href="/article">Article</a></li>
                <li name="tab2"><a href="/music">Music</a></li>
                <li name="tab3"><a href="/about">About</a></li>
            </ul>
        </div>
    </nav>
</div>

<div class="affix"></div>
@yield('content')
</body>

<script>
    $(function () {
        $('#auth-temp').css('background-position', 'right');
    })
</script>
</html>
