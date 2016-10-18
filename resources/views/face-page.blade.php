@extends('layouts.app')

@section('content')
    <style>
        .thumbnail {
            width: 60%;
            margin-left: 20%;
        }
        .thumbnail img {
            width: 99%;
            /*padding-left: 20%;*/
            box-shadow: 2px 2px 2px 2px #b4b4b4;
        }
    </style>
    <script>
        $('.thumbnail img').height($('.thumbnail img').width());
    </script>
    <div class="row" id="categories">
        <div class="col-md-12">
            <div class="page-header">
                <h1>
                    Categories
                </h1>
            </div>
        </div>
        <div class="col-md-4">
            <div class="thumbnail">
                <a href="">
                    <img src="{{ elixir('images/c1.png') }}" alt="">
                </a>
            </div>
        </div>
        <div class="col-md-4">
            <div class="thumbnail">
                <a href="">
                    <img src="{{ elixir('images/c2.png') }}" alt="">
                </a>
            </div>
        </div>
        <div class="col-md-4">
            <div class="thumbnail">
                <a href="">
                    <img src="{{ elixir('images/c3.png') }}" alt="">
                </a>
            </div>
        </div>
        <div class="col-md-4">
            <div class="thumbnail">
                <a href="">
                    <img src="{{ elixir('images/c4.png') }}" alt="">
                </a>
            </div>
        </div>
        <div class="col-md-4">
            <div class="thumbnail">
                <a href="">
                    <img src="{{ elixir('images/c5.png') }}" alt="">
                </a>
            </div>
        </div>
        <div class="col-md-4">
            <div class="thumbnail">
                <a href="">
                    <img src="{{ elixir('images/c6.jpg') }}" alt="">
                </a>
            </div>
        </div>
        <div class="col-md-4">
            <div class="thumbnail">
                <a href="">
                    <img src="{{ elixir('images/c7.png') }}" alt="">
                </a>
            </div>
        </div>
        <div class="col-md-4">
            <div class="thumbnail">
                <a href="">
                    <img src="{{ elixir('images/c9.png') }}" alt="">
                </a>
            </div>
        </div>
    </div>
@endsection