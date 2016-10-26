@extends('layouts.app')

@section('title', 'User Center')

@section('tab','5')

@section('extra-css-js')
    <link rel="stylesheet" href="{{ elixir('assets/css/user-center.css') }}">
    <script src="{{ elixir('assets/js/user-center.js') }}"></script>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12 page-header">
            <h1>
                <small>Hello {{ Auth::user()->name }}!</small>
            </h1>
        </div>
        <div class="col-md-12">
            <button class="btn btn-success btn-lg" data-toggle="modal" data-target="#editModal">Avatar<span
                        class="glyphicon glyphicon-cog"></span>
            </button>
            <button class="btn btn-danger btn-lg" data-toggle="modal" data-target="#backgroundModal">Background<span
                        class="glyphicon glyphicon-cog"></span>
            </button>
        </div>
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
                        <form action="/user/uploadAvatar" method="POST" enctype="multipart/form-data" id="form-avater">
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
                        <form action="/user/uploadBackground" method="POST" enctype="multipart/form-data"
                              id="form-background">
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