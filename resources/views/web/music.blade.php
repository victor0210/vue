@extends('layouts.app')

@section('title', 'Music Page')

@section('content')
    <style>
        .music-navbar {
            width: 100%;
            position: fixed;
            z-index: 3;
        }

        /* Links */
        a,
        a:focus,
        a:hover {
            color: #fff;
        }

        html,
        body {
            height: 100%;
            background-color: #333;
        }

        body {
            color: #fff;
            text-align: center;
            text-shadow: 0 1px 3px rgba(0, 0, 0, .5);
        }

        /* Extra markup and styles for table-esque vertical and horizontal centering */
        .site-wrapper {
            display: table;
            width: 100%;
            height: 100%; /* For at least Firefox */
            min-height: 100%;
            -webkit-box-shadow: inset 0 0 100px rgba(0, 0, 0, .5);
            box-shadow: inset 0 0 100px rgba(0, 0, 0, .5);
        }

        .site-wrapper img {
            width: 100%;
            height: 100%;
            position: fixed;
            z-index: 0;
            -webkit-filter: blur(20px); /* Chrome, Opera */
            -moz-filter: blur(20px);
            -ms-filter: blur(20px);
            filter: blur(20px);
        }

        .site-wrapper-inner {
            z-index: 10;
            display: table-cell;
            vertical-align: top;
        }
    </style>

    </head>


    <div class="site-wrapper">
        <img src="{{ elixir('images/bg4.jpg') }}">
        <div class="site-wrapper-inner">
            <div class="container" style="margin-top: 100px">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Search for music">
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection