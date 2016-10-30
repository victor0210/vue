@extends('layouts.app')

@section('title', 'Music Page')

@section('tab','2')

@section('extra-css-js')
    <link rel="stylesheet" href="{{ elixir('assets/css/music.css') }}">
@endsection

@section('content')
    <div class="row">
        @foreach($articles->sortByDesc('total_view') as $article)
            <div class="col-sm-10  col-md-10 col-xs-12">
                <div class="thumbnail" style="background: url('{{ $article->user->background_url }}') center no-repeat">
                    <div class="row">
                        <div class="col-md-2">
                            <a href="/user/{{ $article->user->id }}"><img src="{{ $article->user->avatar_url }}"
                                                                          alt="..."></a>
                        </div>
                        <div class="col-md-10">
                            <div class="caption">
                                <h3>{{ $article->user->name  }}
                                    <small>{{ $article->total_view }} 看过他写的文章</small>
                                </h3>
                                <p></p>
                                <h5><a href="/content/{{ $article->id }}">代表作: << {{ $article->title }} >> </a></h5>
                                <p>浏览({{ $article->view }})</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection