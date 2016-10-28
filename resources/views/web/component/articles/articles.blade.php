@extends('layouts.app')

@section('title', 'Home Page')

@section('tab','1')

@section('extra-css-js')
    <link rel="stylesheet" href="{{ elixir('assets/css/article.css') }}">
    <script src="{{ elixir('assets/js/article.js') }}"></script>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1">
            <div>
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab"
                                                              data-toggle="tab">Latest</a></li>
                    <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Hottest</a>
                    </li>
                </ul>
                <div class="tab-content">
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
                            <button class="btn btn-success btn-lg show-more" data-status="latest">
                                <span>查看更多 ~ ~</span>
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
                            <button class="btn btn-success btn-lg show-more" data-status="hottest">
                                <span>查看更多 ~ ~</span>
                                <img src="{{ elixir('images/loading.gif') }}">
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            @include('layouts.footer')
        </div>
    </div>
    @include('web.component.article-list-tmpl')
@endsection
