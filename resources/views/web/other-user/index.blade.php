@extends('web.other-user.app')

@section('title', 'Other User')

@section('extra-css-js')

@endsection

@section('content')
    <h1 class="text-center text-gray page-header"><small>{{ $user->name }}</small></h1>
@endsection