@extends('layouts.app')

@section('title', 'User Center')

@section('tab','5')

@section('extra-css-js')

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
@endsection