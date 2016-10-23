@extends('layouts.app')

@section('tab','0')

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
        <div class="col-md-9 col-md-offset-1 col-sm-9 col-sm-offset-1">
            <div class="page-header text-center">
                <h2>
                    Categories
                </h2>
            </div>
        </div>
        <div class="col-md-9 col-md-offset-1 col-sm-9 col-sm-offset-1">
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
    </div>
@endsection