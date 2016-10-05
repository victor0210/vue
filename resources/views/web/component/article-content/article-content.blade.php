@extends('layouts.app')

@section('title', $content->title)

@section('extra-css-js')
    <link rel="stylesheet" href="{{ elixir('assets/css/article-content.css') }}" type="text/css">
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="page-header">
                    <h1>{{ $content->title }}</h1>
                </div>
                <div class="panel-body">
                    {!!  $content->content !!}
                </div>
                <form action="/send-comment/{{ $content->id }}" method="post">
                    {!! csrf_field() !!}
                    <div class="form-group">
                        <lable for="commentsinput"><h3>Comment Area</h3></lable>
                        <textarea id="commentsinput" class="form-control" name="comment" required></textarea>
                        @if ($errors->has('comment'))
                            <span class="help-block">
                                        <strong class="text-danger">{{ $errors->first('comment') }}</strong>
                                    </span>
                        @endif
                            <input type="submit" class="btn btn-primary form-control" value="submit"
                                   style="margin-top: 10px">
                    </div>
                </form>
                @foreach($comments as $item)
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">{{ $item->user_name }}
                            </div>
                            <div class="panel-body">
                                {{ $item->content }}
                            </div>
                            <div class="panel-footer">{{ $item->created_at }}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection