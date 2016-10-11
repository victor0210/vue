@extends('layouts.app')

@section('title', 'User Center')

@section('extra-css-js')
    <link rel="stylesheet" href="{{ elixir('assets/css/user-center.css') }}">
    <script src="{{ elixir('assets/js/user-center.js') }}"></script>
    @endsection

@section('content')
    <div class="jumbotron">
        <div class="container">
            <div class="col-md-3">
                <a href="javascript:void(0);" class="thumbnail">
                    <form action="/user/uploadAvatar" method="POST" enctype="multipart/form-data">
                        {!! csrf_field() !!}
                        <label for="upload-head">
                            <img src="{{ Auth::user()->avatar_url }}" id="user-head">
                        </label>
                        <input type="file" name="avatar" id="upload-head" accept="image/*">
                    </form>
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
                    <h2>My Articles</h2>
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
                    <div class="page-header">
                        <h2>Watching Records</h2>
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



    {{--<button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-sm">Small modal</button>--}}

    <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content text-center alert-danger">
                请勿上传图片格式以外的文件 !
            </div>
        </div>
    </div>
@endsection

