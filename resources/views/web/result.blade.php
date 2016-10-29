@extends('layouts.app')

@section('title', 'Results')

@section('tab','2')

@section('extra-css-js')
@endsection

@section('content')

    <div class="row" data-tag="{{ $tag }}" id="result-container">
        <div class="col-md-10 col-sm-10">
            <div class="page-header">
                <h2>
                    <small>搜索结果:</small>
                </h2>
            </div>
            @if($articles->count()==0)
                <h3>
                    我的天!这里好像什么都没有 <small><a href="/articles/all">让我们去博客公园看看...</a></small>
                </h3>
            @endif

            <ul class="list-group list-unstyled" id="latest">
                @foreach($articles as $item)
                    @include('web.component.article-list')
                @endforeach
            </ul>
            @include('layouts.footer')
        </div>
    </div>

    <script>
        $(function () {
            $('#result-container').html($('#result-container').html().replace($('#result-container').data('tag'), '<span class="text-danger bg-danger">' + $('#result-container').data('tag') + '</span>'));
        })
    </script>
@endsection