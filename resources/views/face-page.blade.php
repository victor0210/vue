@extends('layouts.app')

@section('content')
    <style>
        .thumbnail {
            width: 60%;
            margin-left: 20%;
        }

        .thumbnail img {
            width: 99%;
            /*padding-left: 20%;*/
            box-shadow: 2px 2px 2px 2px #b4b4b4;
        }
    </style>
    <script>
        $('.thumbnail img').height($('.thumbnail img').width());
    </script>
    <div class="row" id="categories">
        <div class="col-md-12">
            <div class="page-header">
                <h1>
                    Categories
                </h1>
            </div>
        </div>
        @foreach($collections as $collection)
            <div class="col-md-4">
                <div class="thumbnail">
                    <a href="{!! route('article',['collection'=>$collection->name]) !!}">
                        <img src="{{ $collection->image }}" alt="">
                    </a>
                </div>
            </div>
        @endforeach
    </div>
@endsection