@extends('layouts.app')

@section('title', 'Edit Article')

@section('extra-css-js')
    @include('editor::head')
@endsection

@section('content')
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <form action="/post-article" method="post">
                {{ csrf_field() }}
                <div class="row">
                    <div class="editor">
                        <input type="text" name="title" placeholder="title" class="form-control" value="{{ old('title') }}"
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
                    <input type="submit" value="Submit" class="btn btn-block btn-primary">
                </div>
            </form>
        </div>
    </div>
@endsection