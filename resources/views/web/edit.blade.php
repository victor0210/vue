@extends('layouts.app-without-animation')

@section('title', '文章添加')

@section('extra-css-js')
    @include('editor::head')
@endsection

@section('content')
    <style>
        label {
            color: #999;
        }
    </style>
    @include('layouts.navbar')
    <div class="container" style="margin-top: 50px;">
        <div class="row" style="margin-bottom: 150px">
            <div class="col-md-10 col-md-offset-1">
                @if($errors->has('fiveMin'))
                    <h2 class="text-center text-danger">{{ $errors->first('fiveMin') }}</h2>
                @endif
                <form action="/post-article" method="post">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="editor">
                            <label for="select">选择分类:</label>
                            <select name="collection" class="form-control" id="select" required>
                                @foreach($collections as $collection)
                                    <option value="{{ $collection->id }}">{{ $collection->name }}</option>
                                @endforeach
                            </select>
                            <label for="title">文章标题:</label>
                            <input type="text" name="title" placeholder="title" class="form-control" id="title"
                                   value="{{ old('title') }}"
                                   required>
                            @if ($errors->has('title'))
                                <span class="help-block">
                                        <strong class="text-danger">{{ $errors->first('title') }}</strong>
                                    </span>
                            @endif
                            <label for="myEditor">文章正文:</label>
                            <textarea id='myEditor' name="contents" required>{{ old('contents') }}</textarea>
                            @if ($errors->has('contents'))
                                <span class="help-block">
                                        <strong class="text-danger">{{ $errors->first('contents') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <input type="submit" value="Submit" class="btn btn-block btn-default">
                    </div>
                </form>
            </div>
        </div>
    </div>
    @include('web.component.notify')
@endsection