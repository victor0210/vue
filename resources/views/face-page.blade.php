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
    <style>
        /*
 * Globals
 */

        /* Links */
        a,
        a:focus,
        a:hover {
            color: #fff;
        }

        /* Custom default button */
        .btn-default,
        .btn-default:hover,
        .btn-default:focus {
            color: #333;
            text-shadow: none; /* Prevent inheritance from `body` */
            background-color: #fff;
            border: 1px solid #fff;
        }

        /*
         * Base structure
         */

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
            /*-webkit-box-shadow: inset 0 0 100px rgba(0, 0, 0, .5);*/
            /*box-shadow: inset 0 0 100px rgba(0, 0, 0, .5);*/
            {{--background: url("{{ elixir('images/bg2.jpg') }}");--}}
        }

        .site-wrapper img{
            width: 100%;
            height: 100%;
            position: fixed;
            z-index: 0;
            -webkit-filter: blur(10px); /* Chrome, Opera */
            -moz-filter: blur(10px);
            -ms-filter: blur(10px);
            filter: blur(10px);
        }

        .site-wrapper-inner {
            z-index:10;
            display: table-cell;
            vertical-align: top;
        }

        .cover-container {
            margin-right: auto;
            margin-left: auto;
        }

        /* Padding for spacing */
        .inner {
            padding: 30px;
        }

        /*
         * Header
         */
        .masthead-brand {
            margin-top: 10px;
            margin-bottom: 10px;
        }

        .masthead-nav > li {
            display: inline-block;
        }

        .masthead-nav > li + li {
            margin-left: 20px;
        }

        .masthead-nav > li > a {
            padding-right: 0;
            padding-left: 0;
            font-size: 16px;
            font-weight: bold;
            color: #fff; /* IE8 proofing */
            color: rgba(255, 255, 255, .75);
            border-bottom: 2px solid transparent;
        }

        .masthead-nav > li > a:hover,
        .masthead-nav > li > a:focus {
            background-color: transparent;
            border-bottom-color: #a9a9a9;
            border-bottom-color: rgba(255, 255, 255, .25);
        }

        .masthead-nav > .active > a,
        .masthead-nav > .active > a:hover,
        .masthead-nav > .active > a:focus {
            color: #fff;
            border-bottom-color: #fff;
        }

        @media (min-width: 768px) {
            .masthead-brand {
                float: left;
            }

            .masthead-nav {
                float: right;
            }
        }

        /*
         * Cover
         */

        .cover {
            padding: 0 20px;
            position: relative;
        }

        .cover .btn-lg {
            padding: 10px 20px;
            font-weight: bold;
        }

        /*
         * Footer
         */

        .mastfoot {
            color: #999; /* IE8 proofing */
            color: rgba(255, 255, 255, .5);
        }

        /*
         * Affix and center
         */

        @media (min-width: 768px) {
            /* Pull out the header and footer */
            .masthead {
                position: fixed;
                top: 0;
            }

            .mastfoot {
                position: fixed;
                bottom: 0;
            }

            /* Start the vertical centering */
            .site-wrapper-inner {
                vertical-align: middle;
            }

            /* Handle the widths */
            .masthead,
            .mastfoot,
            .cover-container {
                width: 100%; /* Must be percentage or pixels for horizontal alignment */
            }
        }

        @media (min-width: 992px) {
            .masthead,
            .mastfoot,
            .cover-container {
                width: 700px;
            }
        }
    </style>

</head>


<div class="site-wrapper">
    <img src="{{ elixir('images/bg4.jpg') }}">
    <div class="site-wrapper-inner">

        <div class="cover-container">

            <div class="masthead clearfix">
                <div class="inner">
                    <h3 class="masthead-brand">LightBlog</h3>
                    <nav>
                        <ul class="nav masthead-nav">
                            <li class="active"><a href="#">Home</a></li>
                            <li><a href="article">Articles</a></li>
                            <li><a href="music">Music</a></li>
                        </ul>
                    </nav>
                </div>
            </div>

            <div class="inner cover">
                <h1 class="cover-heading">Drawing your blog.</h1>
                <p class="lead">LightBlog is a technical platform for everyone who likes IT . Creating your own blog in a light way .</p>
                <p class="lead">
                    <a href="article" class="btn btn-lg btn-default">Get Start</a>
                </p>
            </div>

            <div class="mastfoot">
                <div class="inner">
                    <p>Blog template for <a href="http://getbootstrap.com">Bootstrap</a> and <a href="http://laravel.com">Laravel</a>, by <a
                                href="#">@dandy</a>.</p>
                </div>
            </div>

        </div>

    </div>

</div>
</body>
</html>