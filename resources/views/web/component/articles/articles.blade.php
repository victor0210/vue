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
                        <ul class="list-group list-unstyled hottest">
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
                    </div>
                    <div role="tabpanel" class="tab-pane" id="profile">
                        <ul class="list-group list-unstyled">
                            <li>
                                @foreach($collections as $collection)
                                    <a href="/article/{{ $collection->name }}"><span
                                                class="badge">{{ $collection->name }}</span></a>
                                @endforeach
                            </li>
                            @foreach($articles->sortByDesc('comment_count') as $item)
                                @include('web.component.article-list')
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="text-center">
                <button class="btn btn-success btn-lg show-more">查看更多 ~ ~
                </button>
            </div>
            @include('layouts.footer')
        </div>
    </div>
    @include('web.component.article-list-tmpl')
    <script>
        $(function () {
            var page = 3;

            $('.thumbnail img').height($('.thumbnail img').width());
            $(window).resize(function () {
                $('.thumbnail img').height($('.thumbnail img').width());
            })

            $('.show-more').click(function () {
                $.ajax('/api/articles-list?page=' + page, {
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'GET',
                    success: function (data) {
                        if (data.data != '') {
                            var data = data.data;
                            data.map(function (index) {
                                var text = tmpl('article-list', index);
                                $('.list-group.hottest').append(text);
                            });
                            page++;
                        }
                        else $('.show-more').text('No More !').attr('disabled','disabled');
                    },
                    error: function () {
                        alert('请求失败');
                    }
                });
            });
        });
    </script>
@endsection
