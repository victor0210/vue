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
            <h1 class="page-header">
                个人中心
            </h1>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <div>
                    <h3>
                        <small>
                            Articles
                            <button class="btn btn-sm btn-warning pull-right articles-edit"><span
                                        class="glyphicon glyphicon-edit"></span>Edit
                            </button>
                        </small>
                    </h3>
                </div>
                <div class="row" style="margin-bottom: 100px">
                    @foreach($articles as $article)
                        <div class="col-md-12">
                            <li class="list-group-item" id="articles-board">
                                <p><a href="content/{{ $article->id }}">{{$article->title}}</a></p>
                                <p><span class="badge articles-badge">{{ $article->comment_count }}</span>
                                    <span class="glyphicon glyphicon-remove text-danger articles-remove"
                                          data-id="{{ $article->id }}"></span></p>
                            </li>
                        </div>
                    @endforeach
                </div>
            </div>
            @if($records)
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div>
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
                                    <p><a href="content/{{ $record->article_id }}">{{$record->title}}</a></p>
                                    <p>
                                        <span class="badge records-badge">{{ $record->updated_at->diffForHumans() }}</span>
                                        <span class="glyphicon glyphicon-remove text-danger records-remove"
                                              data-id="{{ $record->id }}"></span></p>
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