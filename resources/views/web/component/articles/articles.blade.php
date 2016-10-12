@extends('layouts.app')

@section('title', 'Home Page')

@section('extra-css-js')
    <link rel="stylesheet" href="{{ elixir('assets/css/article.css') }}">
    @endsection
@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div>
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Latest</a></li>
                        <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Hottest</a></li>
                    </ul>
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="home">
                            <ul class="list-group">
                                @foreach($articles as $item)
                                    <li class="list-group-item">
                                        <span class="badge">Comments: {{ $item->comment_count }}</span>
                                        <span class="badge">Create: {{ $item->created_at }}</span>
                                        <a href="content/{{ $item->id }}">
                                            {{$item->title}}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="profile">
                            <ul class="list-group">
                                @foreach($articles->sortByDesc('comment_count') as $item)
                                    <li class="list-group-item">
                                        <span class="badge">Comments: {{ $item->comment_count }}</span>
                                        <span class="badge">Create: {{ $item->created_at }}</span>
                                        <a href="content/{{ $item->id }}">
                                            {{$item->title}}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection