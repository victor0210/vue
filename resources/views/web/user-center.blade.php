@extends('layouts.app')

@section('title', 'User Center')

@section('content')
    <div class="jumbotron">
        <div class="container">
            <div class="col-md-3">
                <a href="#" class="thumbnail">
                    <img src="{{ elixir('images/thumbligrid.jpg') }}" alt="...">
                </a>
            </div>
            <div class="col-md-3">
                <div class="row">
                    <h3>{{ $username }}'s user center</h3>
                    <a href="/add-article" class="btn btn-primary">add article</a>
                    @if(Auth::user()->is_admin)
                        <a href="/admin" class="btn btn-default">admin center</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="container" style="margin-bottom: 100px">
        <div class="row">
            <div class="col-md-6">
                <div class="page-header">
                    <h2>My Article</h2>
                </div>
                <div class="row">
                    @foreach($articles as $article)
                        <div class="col-md-12">
                            <li class="list-group-item">
                                <span class="badge">{{ $article->comment_count }}</span>
                                <a href="content/{{ $article->id }}">{{$article->title}}</a>
                            </li>
                        </div>
                    @endforeach
                </div>
            </div>
            @if($records)
                <div class="col-md-6">
                    <div class="page-header text-right">
                        <h2>浏览记录</h2>
                    </div>
                    <div class="row">
                        @foreach($records as $record)
                            <div class="col-md-12">
                                <li class="list-group-item">
                                    <span class="badge">{{ $record->updated_at }}</span>
                                    <a href="content/{{ $record->article_id }}">{{$record->title}}</a>
                                </li>
                            </div>
                        @endforeach
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            @if($records->previousPageUrl())
                                <a href="{{ $records->previousPageUrl() }}" class="btn btn-link pull-left">previous
                                    page</a>
                            @endif
                            @if($records->nextPageUrl())
                                <a href="{{ $records->nextPageUrl() }}" class="btn btn-link pull-right">next
                                    page</a>
                            @endif
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection