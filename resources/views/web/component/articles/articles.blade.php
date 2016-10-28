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
    <script>
        $(function () {
            var page_latest = 3;
            var page_hottest = 3;
            $('.thumbnail img').height($('.thumbnail img').width());
            $(window).resize(function () {
                $('.thumbnail img').height($('.thumbnail img').width());
            })

            $('.show-more').click(function () {
                $(this).find('span').hide();
                $(this).find('img').show();
                var status = $(this).data('status');
                switch (status) {
                    case 'latest':
                        var page = page_latest++;
                        break;
                    case 'hottest':
                        var page = page_hottest++;
                        break;
                }
                $.ajax('/api/articles-list?page=' + page, {
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'GET',
                    data: {status: status},
                    success: function (data) {
                        if (data.next_page_url == null) {
                            $('.show-more[data-status=' + status + ']').text('No More !').attr('disabled', 'disabled');
                        }
                        if (data.data != '') {
                            var data = data.data;
                            data.map(function (index) {
                                var text = tmpl('article-list', index);
                                $('#' + status).append(text);
                            });
                            $('.show-more[data-status=' + status + ']').find('span').show();
                            $('.show-more[data-status=' + status + ']').find('img').hide();
                        }
                    },
                    error: function () {
                        alert('请求失败');
                    }
                });
            });
        });
    </script>
@endsection
