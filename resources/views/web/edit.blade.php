@extends('layouts.app-without-animation')

@section('title', 'Edit Article')

@section('extra-css-js')
    @include('editor::head')
@endsection

@section('content')
    <style>
        body {
            background-color: #2e2e2e;
        }
        .container *{
            font-family: 'Monaco', 'Lucida Console', monospace;
        }
    </style>
    @include('layouts.navbar')
    <div class="container" style="margin-top: 50px;opacity: 0.9;">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <form action="/post-article" method="post">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="editor">
                            <input type="text" name="title" placeholder="title" class="form-control"
                                   value="{{ old('title') }}"
                                   required>
                            @if ($errors->has('title'))
                                <span class="help-block">
                                        <strong class="text-danger">{{ $errors->first('title') }}</strong>
                                    </span>
                            @endif
                            <textarea id='myEditor' name="contents" value="{{ old('contents') }}" required></textarea>
                            @if ($errors->has('contents'))
                                <span class="help-block">
                                        <strong class="text-danger">{{ $errors->first('contents') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <input type="submit" value="Submit" class="btn btn-block btn-dark">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection