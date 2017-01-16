@extends('admin.layout.dashboard')
@section('page_heading','标题 : '.$article->title)
@section('section')
    <style>
        img {
            max-width: 100%;
        }
    </style>

    <div class="col-md-12" id="list-article">
        {!! $article->content !!}
    </div>
@endsection