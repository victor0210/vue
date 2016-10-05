@extends('layouts.app')

@section('title', 'Home Page')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <ul class="list-group">
                    @foreach($articles as $item)
                        <li class="list-group-item">
                            <span class="badge">Comments: {{ $item->comment_count }}</span>
                            <span class="badge">Create: {{ $item->created_at }}</span>
                            <a href="content/{{ $item->id }}">
                                {{$item->title}}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endsection