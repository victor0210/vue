@extends('layouts.app')

@section('title', 'Home Page')

@section('extra-css-js')
    <link rel="stylesheet" href="{{ elixir('assets/css/article.css') }}">
@endsection
@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <div>
                    <ul class="nav nav-tabs nav-justified" role="tablist">
                        <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab"
                                                                  data-toggle="tab">Latest</a></li>
                        <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Hottest</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="home">
                            <ul class="list-group">
                                @foreach($articles as $item)
                                    <li class="list-group-item">
                                        <div class="row">
                                            <div class="col-md-12 article-list-title" >
                                                <a href="content/{{ $item->id }}">
                                                    {{$item->title}}jkkjjkjkjkjkjkjjkkjjkjkjkjkjkjjkkjjkjkjkjkjkjjkkjjkjkjkjkjkjjkkjjkjkjkjkjkj
                                                </a>
                                            </div>
                                            <div class="col-md-12">
                                                <span class="badge pull-left">Comments: {{ $item->comment_count }}</span>
                                                <span class="badge pull-right">Create: {{ $item->created_at }}</span>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="profile">
                            <ul class="list-group">
                                @foreach($articles->sortByDesc('comment_count') as $item)
                                    <li class="list-group-item">
                                        <div class="row">
                                            <div class="col-md-12 article-list-title" >
                                                <a href="content/{{ $item->id }}">
                                                    {{$item->title}}jkkjjkjkjkjkjkjjkkjjkjkjkjkjkjjkkjjkjkjkjkjkjjkkjjkjkjkjkjkjjkkjjkjkjkjkjkj
                                                </a>
                                            </div>
                                            <div class="col-md-12">
                                                <span class="badge pull-left">Comments: {{ $item->comment_count }}</span>
                                                <span class="badge pull-right">Create: {{ $item->created_at }}</span>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-6">
                <div class="page-header">
                    <h2 class="text-info text-center">Recommend</h2>
                </div>
                <div class="thumbnail">
                    <div class="jumbotron">
                        <img src="{{ Auth::user()->avatar_url }}">
                    </div>
                    <div class="caption">
                        <h3>Refer : {{ Auth::user()->name }}</h3>
                        <p>免贵叫彦祖!希望大家可以多多交流</p>
                        <p><button class="btn btn-info btn-lg" role="button"> Send Messages </button></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $('.thumbnail img').height($('.thumbnail img').width());
        $(window).resize(function () {
            $('.thumbnail img').height($('.thumbnail img').width());
        })
    </script>
@endsection