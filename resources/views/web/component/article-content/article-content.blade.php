@extends('layouts.app')

@section('title', $content->title)

@section('tab','1')

@section('extra-css-js')
    <link rel="stylesheet" href="{{ elixir('assets/css/article-content.css') }}" type="text/css">
@endsection

@section('content')
    <div class="row" id="article-main-content">
        <div class="col-md-10 col-md-offset-1">
            <div class="page-header">
                <h2>
                    {{ $content->title }}
                </h2>
            </div>
            <div class="well" id="article-content">
                {!!  $content->content !!}
            </div>
            <form action="/send-comment/{{ $content->id }}" method="post">
                {!! csrf_field() !!}
                <div class="form-group">
                    <lable for="commentsinput">
                        <h3>Comment Area
                            <small>(Not support markdown now )</small>
                        </h3>
                    </lable>
                    <textarea id="commentsinput" class="form-control" name="comment" required></textarea>
                    @if ($errors->has('comment'))
                        <span class="help-block">
        <strong class="text-danger">{{ $errors->first('comment') }}</strong>
        </span>
                    @endif
                    <input type="submit" class="btn btn-undark form-control" value="submit"
                           style="margin-top: 10px">
                </div>
            </form>
            @foreach($comments as $item)
                <div class="col-md-12">
                    <div class="page-header">
                        <p class="text-primary comment-title"><img src="{{ $item->user->avatar_url }}" class="comment-avatar"
                                                     alt="avatar">{{ $item->user_name }} :</p>
                        <p class="comment-content">{{ $item->content }}</p>
                        <div class="comment-footer">{{ $item->created_at }}
                            @if(Auth::check())
                                @if(Auth::user()->name!=$item->user_name)
                                    <span class="btn btn-undark reply"
                                          data-toggle="modal"
                                          data-target="#myModal"
                                          data-receiver="{{ $item->user->id }}"
                                          data-comment="{{ $item->id }}">Reply</span>
                                @endif
                            @else
                                <a href="/login"><span class="btn btn-undark reply">Reply</span></a>
                            @endif
                        </div>
                    </div>

                    @if($item->reply->count()>0)
                        <div class="well reply-well">
                            <ul class="list-group reply-list">
                                @foreach($item->reply->sortByDesc('created_at') as $reply)
                                    <li class="list-group-item">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <a href="">{{ $reply->sender->name }}</a> reply to <a
                                                        href="">{{ $reply->receiver->name }} </a>: {{ $reply->content }}
                                                <p class="text-gray">{{ $reply->created_at }}
                                                    @if(Auth::check())
                                                        @if(Auth::user()->id!=$reply->sender->id)
                                                            <span class="btn btn-undark reply"
                                                                  data-toggle="modal"
                                                                  data-target="#myModal"
                                                                  data-receiver="{{ $reply->sender->id }}"
                                                                  data-comment="{{ $item->id }}">Reply :</span>
                                                        @endif
                                                    @else
                                                        <a href="/login"><span
                                                                    class="btn btn-undark reply">Reply :</span></a>
                                                    @endif
                                                </p>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Reply Area</h4>
                </div>
                <div class="modal-body">
                    <form action="/reply-comment" method="post" id="reply-form">
                        {!! csrf_field() !!}
                        <div class="form-group">
                            <input type="hidden" name="comment">
                            <input type="hidden" name="receiver">
                            <textarea name="content" id="reply-area" cols="30" rows="10"
                                      class="form-control"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="reply-submit">Reply</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        $('#reply-submit').click(function () {
            $('#reply-form').submit();
        });

        $('.reply').click(function () {
            $('input[name=receiver]').val($(this).data('receiver'));
            $('input[name=comment]').val($(this).data('comment'));
        });
    </script>
@endsection