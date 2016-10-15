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
                                    @include('web.component.article-list')
                                @endforeach
                            </ul>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="profile">
                            <ul class="list-group">
                                @foreach($articles->sortByDesc('comment_count') as $item)
                                    @include('web.component.article-list')
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-6">
                <div class="page-header">
                    <h2 class="text-info">Recommend</h2>
                </div>
                <div class="thumbnail">
                    <div class="jumbotron">
                        <img src="">
                    </div>
                    <div class="caption">
                        <h3>Refer : XXX</h3>
                        <p>免贵叫彦祖!希望大家可以多多交流</p>
                        <p>
                            <button class="btn btn-info" role="button"> Send Messages</button>
                        </p>
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