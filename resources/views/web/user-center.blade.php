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
            </h1>
        </div>
        <div class="col-md-12">
            <div class="btn-group pull-left">
                <button class="btn btn-default btn-lg" data-toggle="modal" data-target="#editModal">Avatar Upload <span
                            class="glyphicon glyphicon-cog"></span>
                </button>
                <button class="btn btn-dark btn-lg" data-toggle="modal" data-target="#backgroundModal">Background Upload <span
                            class="glyphicon glyphicon-cog"></span>
                </button>
            </div>
        </div>
        <div class="col-md-12 col-sm-12 col-xs-12 text-center">
            <div class="btn-group pull-left">
                <a href="/add-article" class="btn btn-lg btn-primary">Add Article</a>
                <a href="/article" class="btn btn-lg btn-danger">Article Center</a>
                @if(Auth::user()->isAdmin())
                    <a href="/admin" class="btn btn-lg btn-warning">Admin Center</a>
                @endif
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
                        <form action="/user/uploadAvatar" method="POST" enctype="multipart/form-data"  id="form-avater">
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

    <div class="modal fade" id="backgroundModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Upload Background</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <form action="/user/uploadBackground" method="POST" enctype="multipart/form-data"  id="form-background">
                            <div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3 col-xs-12">
                                <a href="javascript:void(0);" class="thumbnail">
                                    {!! csrf_field() !!}
                                    <label for="upload-background">
                                        <img src="{{ Auth::user()->background_url }}" id="user-background">
                                    </label>
                                    <input type="file" name="background" id="upload-background" accept="image/*">
                                </a>
                            </div>
                        </form>
                    </div>
                    <div class="row">
                        <div class="alert-success text-center"> 请上传高清图片以得到更好的体验 !
                        </div>
                        <div class="alert-danger text-center" style="display: none"> 请勿上传图片格式以外的文件 !
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection