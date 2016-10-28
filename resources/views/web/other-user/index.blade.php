@extends('web.other-user.app')

@section('title', 'Other User')

@section('extra-css-js')

@endsection

@section('content')
    <div class="row">
        <div class="col-md-10">
            <h1 class="text-center text-gray page-header">
                <small>{{ $user->name }}</small>
            </h1>
            <div class="row">
                <div class="col-md-12">
                    @if($articles->count()>0)
                        <h3>
                            <small>他的文章:</small>
                        </h3>
                        @foreach($articles as $item)
                            @include('web.component.article-list')
                        @endforeach
                        @if($articles->lastPage()==$articles->currentPage())
                            <hr>
                            <span><a href="/user/{{$user->id}}/article">查看他的全部文章...</a></span>
                        @endif
                    @else
                        <h3>
                            <small> 这个人很懒,还没有写过什么作品 ^_^ !!
                            </small>
                        </h3>
                    @endif
                    @if($records->count()==0)
                        <h3>
                            <small> 好像还么有人来看过他的作品 ~.~ !!
                            </small>
                        </h3>
                    @else
                        <h3>
                            <small>最近访客:</small>
                        </h3>
                        @foreach($records as $item)
                            <a href="/user/{{ $item->user->id }}"><img
                                        style="width: 25px;height: 25px;margin:2px;border-radius: 50%"
                                        src="{{ $item->user->avatar_url }}" data-toggle="tooltip"
                                        data-placement="bottom"
                                        title="{{ $item->user->name }} 在 {{ $item->created_at }}看了
                                    <<{{ $item->article->title }}>>"></a>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })
    </script>
@endsection