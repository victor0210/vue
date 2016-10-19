@extends('layouts.app')

@section('title', 'Music Page')

@section('tab','2')

@section('extra-css-js')
    <link rel="stylesheet" href="{{ elixir('assets/css/music.css') }}">
@endsection

@section('content')
    <div class="row">
        Music
    </div>
@endsection