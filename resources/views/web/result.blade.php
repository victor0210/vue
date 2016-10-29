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
                    <small>Results</small>
                </h2>
            </div>
            @if($articles->count()==0)
                <h3>
                    厉害了我的哥,这里貌似什么都没有!<small><a href="/article/all">让我们去博客公园看看...</a></small>
                </h3>
            @endif

            <ul class="list-group list-unstyled" id="latest">
                @foreach($articles->sortByDesc('created_at') as $item)
                    @include('web.component.article-list')
                @endforeach
            </ul>
            @include('layouts.footer')
        </div>
    </div>

    <script>
        $(function () {
            var tag=$('#result-container').data('tag');
            var rep=new RegExp(tag,'g');
            $('#result-container').html($('#result-container').html().replace(rep,'<span class="text-danger bg-danger">' + $('#result-container').data('tag') + '</span>'));
        })
    </script>
@endsection