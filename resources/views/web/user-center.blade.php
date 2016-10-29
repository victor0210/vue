@extends('layouts.app')

@section('title', 'User Center')

@section('tab','4')

@section('extra-css-js')
    <link rel="stylesheet" href="{{ elixir('assets/css/user-center.css') }}">
    <script src="{{ elixir('assets/js/user-center.js') }}"></script>
@endsection

@section('content')
    <div class="row user-center">
        <div class="col-md-10 col-sm-10">
            <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="page-header">
                    <h3>
                        <small>
                            Articles
                            <button class="btn btn-sm btn-warning pull-right articles-edit"><span
                                        class="glyphicon glyphicon-edit"></span>Edit
                            </button>
                        </small>
                    </h3>
                </div>
                <div class="row">
                    @foreach($articles as $article)
                        <div class="col-md-12">
                            <li class="list-group-item" id="articles-board">
                                <span class="badge articles-badge">{{ $article->comment_count }}</span>
                                <a href="content/{{ $article->id }}">{{$article->title}}</a>
                                <span class="glyphicon glyphicon-remove text-danger pull-right articles-remove"
                                      data-id="{{ $article->id }}"></span>
                            </li>
                        </div>
                    @endforeach
                </div>
                <div class="row">
                    <div class="col-md-12">
                        @if($articles->previousPageUrl())
                            <a href="{{ $articles->previousPageUrl() }}" class="btn btn-link pull-left">previous
                                page</a>
                        @endif
                        @if($articles->nextPageUrl())
                            <a href="{{ $articles->nextPageUrl() }}" class="btn btn-link pull-right">next
                                page</a>
                        @endif
                    </div>
                </div>
            </div>
            @if($records)
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="page-header">
                        <h3>
                            <small>Records
                                <button class="btn btn-sm btn-warning pull-right records-edit"><span
                                            class="glyphicon glyphicon-edit"></span>Edit
                                </button>
                            </small>
                        </h3>
                    </div>
                    <div class="row">
                        @foreach($records->sortByDesc('updated_at') as $record)
                            <div class="col-md-12" title="{{ $record->article_id }}">
                                <li class="list-group-item" id="records-board">
                                    <span class="badge records-badge">{{ $record->updated_at->diffForHumans() }}</span>
                                    <a href="content/{{ $record->article_id }}">{{$record->title}}</a>
                                    <span class="glyphicon glyphicon-remove text-danger pull-right records-remove"
                                          data-id="{{ $record->id }}"></span>
                                </li>
                            </div>
                        @endforeach
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            @if($records->previousPageUrl())
                                <a href="{{ $records->previousPageUrl() }}" class="btn btn-link pull-left">previous
                                    page</a>
                            @endif
                            @if($records->nextPageUrl())
                                <a href="{{ $records->nextPageUrl() }}" class="btn btn-link pull-right">next
                                    page</a>
                            @endif
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <div class="modal fade" id="reply-modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <p id="reply-info" class="text-center"></p>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@endsection