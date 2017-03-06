@extends('layouts.app')

@section('title', '论塘')

@section('tab','2')

@section('content')

    <div class="row" data-tag="{{ $tag }}" id="result-container">
        <div class="col-md-10 col-sm-10">
            <div class="page-header">
                <h1>
                    搜索结果
                </h1>
            </div>
            @if($articles->count()==0)
                <h3>
                    厉害了我的哥,这里貌似什么都没有!
                    <small><a href="/">让我们去博客公园看看...</a></small>
                </h3>
            @endif

            <ul class="list-group list-unstyled" id="latest">
                @foreach($articles->sortByDesc('created_at') as $item)
                    @include('web.component.article-list')
                @endforeach
            </ul>
        </div>
    </div>
@endsection