@extends('layouts.app')

@section('title', '论塘')

@section('tab','1')

@section('extra-css-js')
    <link rel="stylesheet" href="{{ elixir('assets/css/article.css') }}">
    <script src="{{ elixir('assets/js/article.js') }}"></script>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-10 col-sm-10">
            <div>
                <ul class="nav nav-tabs" role="tablist">
                    @if($page=='all')
                        <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab"
                                                                  data-toggle="tab">Latest</a></li>
                        <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Hottest</a>
                        </li>
                    @else
                        <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab"
                                                                  data-toggle="tab">{{ $page }}</a></li>
                    @endif
                </ul>
                <div class="tab-content">
                    @if($articles->count()==0)
                        <h2>
                            <small> 这里好像什么都没有 , -_-!!
                            </small>
                        </h2>
                        <a href="/add-article" class="btn btn-danger">抢占第一坑</a>
                    @else
                        @if($page=='all')
                            <div role="tabpanel" class="tab-pane active" id="home">
                                <ul class="list-group list-unstyled" id="latest">
                                    <li>
                                        @foreach($collections as $collection)
                                            <a href="/article/{{ $collection->name }}"><span
                                                        class="badge">{{ $collection->name }}</span></a>
                                        @endforeach
                                    </li>
                                    @foreach($articles as $item)
                                        @include('web.component.article-list')
                                    @endforeach
                                </ul>
                                <div class="text-center">
                                    <button class="btn btn-success show-more" data-status="latest">
                                        <span>查看更多</span>
                                        <img src="{{ elixir('images/loading.gif') }}">
                                    </button>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="profile">
                                <ul class="list-group list-unstyled" id="hottest">
                                    <li>
                                        @foreach($collections as $collection)
                                            <a href="/article/{{ $collection->name }}"><span
                                                        class="badge">{{ $collection->name }}</span></a>
                                        @endforeach
                                    </li>
                                    @foreach($articles->sortByDesc('view') as $item)
                                        @include('web.component.article-list')
                                    @endforeach
                                </ul>
                                <div class="text-center">
                                    <button class="btn btn-success show-more" data-status="hottest">
                                        <span>查看更多</span>
                                        <img src="{{ elixir('images/loading.gif') }}">
                                    </button>
                                </div>
                            </div>
                        @else
                            <div role="tabpanel" class="tab-pane active" id="home">
                                <ul class="list-group list-unstyled" id="another">
                                    <li>
                                        @foreach($collections as $collection)
                                            <a href="/article/{{ $collection->name }}"><span
                                                        class="badge">{{ $collection->name }}</span></a>
                                        @endforeach
                                    </li>
                                    @foreach($articles as $item)
                                        @include('web.component.article-list')
                                    @endforeach
                                </ul>
                                <div class="text-center">
                                    <button class="btn btn-success show-more" data-status="{{ $page }}">
                                        <span>查看更多</span>
                                        <img src="{{ elixir('images/loading.gif') }}">
                                    </button>
                                </div>
                            </div>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
    @include('web.component.article-list-tmpl')
@endsection
