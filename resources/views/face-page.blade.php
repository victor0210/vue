@extends('layouts.app')

@section('title','推荐分类')

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
        <div class="col-md-10  col-sm-10 ">
            <div class="page-header text-center">
                <h1>
                    <small>推荐分类</small>
                </h1>
            </div>
        </div>
        <div class="col-md-10 col-sm-10">
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