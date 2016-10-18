@extends('layouts.app')

@section('title', 'User Center')

@section('tab','5')

@section('extra-css-js')
    <link rel="stylesheet" href="{{ elixir('assets/css/user-center.css') }}">
    <script src="{{ elixir('assets/js/user-center.js') }}"></script>
@endsection

@section('content')
    <div class="row user-center">
        <div class="col-md-12 col-sm-12 col-xs-12 page-header">
            <h1>{{ Auth::user()->name }}
                <small>Welcome to UserCenter !</small>
                <span class="glyphicon glyphicon-cog" style="font-family: 'Glyphicons Halflings';cursor: pointer"
                      data-toggle="modal" data-target="#editModal"></span>
            </h1>
        </div>
        <div class="col-md-12 col-sm-12 col-xs-12 text-center">
            <div class="btn-group pull-left">
                <a href="/add-article" class="btn btn-lg btn-primary">Add Article</a>
                <a href="/article" class="btn btn-lg btn-dark">Article Center</a>
                <a href="/admin" class="btn btn-lg btn-warning">Admin Center</a>
            </div>
        </div>
    </div>
    <div class="row user-center">
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
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Upload Avatar</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <form action="/user/uploadAvatar" method="POST" enctype="multipart/form-data">
                            <div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3 col-xs-12">
                                <a href="javascript:void(0);" class="thumbnail">
                                    {!! csrf_field() !!}
                                    <label for="upload-head">
                                        <img src="{{ Auth::user()->avatar_url }}" id="user-head">
                                    </label>
                                    <input type="file" name="avatar" id="upload-head" accept="image/*">
                                </a>
                            </div>
                        </form>
                    </div>
                    <div class="row">
                        <div class="alert-danger text-center" style="display: none"> 请勿上传图片格式以外的文件 !
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection