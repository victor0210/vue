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
                            <small>他的文章:{{ $articles->total() }} 篇</small>
                        </h3>
                        @foreach($articles as $item)
                            @include('web.component.article-list')
                        @endforeach
                        <div class="col-md-6 text-left" style="margin-top: 10px">
                            @if($articles->lastPage()!=1&&$articles->currentPage()>1)
                                <a href="/user/{{ $user->id }}/article?page={{ $articles->currentPage()-1 }}"
                                   class="badge">上一页</a>
                            @endif
                            @if($articles->lastPage()>$articles->currentPage())
                                <a href="/user/{{ $user->id }}/article?page={{ $articles->currentPage()+1 }}"
                                   class="badge">下一页</a>
                            @endif
                        </div>
                    @elseif($articles->currentPage()==1&&$articles->count()==0)
                        <h3>
                            <small> 这个人很懒,还没有写过什么作品 ^_^ !!
                            </small>
                        </h3>
                    @else
                        <h3 class="text-center">
                            <small>这里空荡荡的 <br><a href="/user/{{ $user->id }}">返回他的个人中心</a></small>
                        </h3>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection