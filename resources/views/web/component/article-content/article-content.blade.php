@extends('web.other-user.app')

@section('title', $content->title)

@section('tab','1')

@section('extra-css-js')
    <link rel="stylesheet" href="{{ elixir('assets/css/article-content.css') }}" type="text/css">
@endsection

@section('content')
    <div class="row" id="article-main-content" data-article-id="{{ $content->id }}">
        <div class="col-md-9 col-md-offset-1">
            <div class="page-header">
                <img src="{{ $content->user->avatar_url }}" alt="" style="width: 40px;height: 40px;border-radius: 50%">
                <a href="">{{ $content->user->name }}</a> · <span
                        style="color:#b4b4b4">{{ $content->created_at->format('M·d·Y')}}</span>
                @if(Auth::check())
                    @if($status==true)
                        <button class="btn btn-success" disabled>已赞 <span class="fa fa-thumbs-up"></span></button>
                    @else
                        <button class="btn btn-success" id="thumb-up">赞一个 <span class="fa fa-thumbs-up"></span></button>
                    @endif
                @else
                    <a href="/login" class="btn btn-success" id="thumb-up">赞一个 <span class="fa fa-thumbs-up"></span></a>
                @endif
            </div>
            <div id="article-content">
                {!!  $content->content !!}
            </div>
            <p style="color:#999">recent browse :
                @foreach($records as $item)
                    <a href="/user/{{ $item->user->id }}" style="display: inline-block"><img
                                style="width: 25px;height: 25px;margin-top:5px;margin-right:-15px;border-radius: 50%"
                                src="{{ $item->user->avatar_url }}" data-toggle="tooltip"
                                data-placement="bottom" title="{{ $item->user->name }}"></a>
                @endforeach
            </p>
            @foreach($comments as $item)
                <div class="col-md-12">
                    <div class="page-header">
                        <img src="{{ $item->user->avatar_url }}"
                             class="comment-avatar"
                             alt="avatar" style="display: inline-block">
                        <p class="comment-title"
                           style="font-size: 12px;line-height: 18px;display: inline-block">{{ $item->user_name }}
                            <br/><span style="color: #999;">{{ $item->created_at->format('M·d·Y') }}</span></p>
                    </div>
                    <p class="comment-content well">{{ $item->content }}</p>
                    <div class="comment-footer">
                        <span class="badge">{{ $item->created_at->diffForHumans() }}</span>
                        @if(Auth::check())
                            @if(Auth::user()->name!=$item->user_name)
                                <span class="btn btn-link reply"
                                      data-toggle="modal"
                                      data-target="#myModal"
                                      data-receiver="{{ $item->user->id }}"
                                      data-comment="{{ $item->id }}">回复</span>
                            @endif
                        @else
                            <a href="/login"><span class="btn btn-link reply">回复</span></a>
                        @endif
                    </div>

                    @if($item->reply->count()>0)
                        <div class="reply-well">
                            <ul class="list-group reply-list">
                                @foreach($item->reply->sortByDesc('created_at') as $reply)
                                    <li class="list-group-item">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <a href=""><img src="{{ $reply->sender->avatar_url }}"
                                                                class="reply-avatar">{{ $reply->sender->name }}</a>
                                                <span class="glyphicon glyphicon-bullhorn text-danger"
                                                      title="reply to"
                                                      style="font-family: 'Glyphicons Halflings';"></span>
                                                <a href=""><img src="{{ $reply->receiver->avatar_url }}"
                                                                class="reply-avatar">{{ $reply->receiver->name }}
                                                </a>: {{ $reply->content }}
                                                <p class="text-gray"><span
                                                            class="badge">{!! $reply->created_at->diffForHumans() !!}</span>
                                                    @if(Auth::check())
                                                        @if(Auth::user()->id!=$reply->sender->id)
                                                            <span class="btn btn-link reply"
                                                                  data-toggle="modal"
                                                                  data-target="#myModal"
                                                                  data-receiver="{{ $reply->sender->id }}"
                                                                  data-comment="{{ $item->id }}">回复</span>
                                                        @endif
                                                    @else
                                                        <a href="/login"><span
                                                                    class="btn btn-link reply">回复</span></a>
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
        <div class="comment-area col-md-9 col-md-offset-1">
            <form action="/send-comment/{{ $content->id }}" method="post">
                {!! csrf_field() !!}
                <div class="form-group">
                    <lable for="commentsinput">
                    </lable>
                    <textarea id="commentsinput" class="form-control" name="comment" required></textarea>
                    @if ($errors->has('comment'))
                        <span class="help-block">
        <strong class="text-danger">{{ $errors->first('comment') }}</strong>
        </span>
                    @endif
                    <input type="submit" class="btn btn-success form-control" value="submit"
                           style="margin-top: 10px">
                </div>
            </form>
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
                    <button type="button" class="btn btn-success" id="reply-submit">Reply</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(function () {
            $('#reply-submit').click(function () {
                $('#reply-form').submit();
            });

            $('.reply').click(function () {
                $('input[name=receiver]').val($(this).data('receiver'));
                $('input[name=comment]').val($(this).data('comment'));
            });
            $('#thumb-up').click(function () {
                var url = '/api/thumbs';
                $.ajax(url, {
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'post',
                    data: {'article_id': $('#article-main-content').data('article-id')},
                    success: function (data) {
                        $('#thumb-up').html('已赞 <span class="fa fa-thumbs-up"></span>').attr('disabled', 'disabled');
                    }
                });
            });
            $('[data-toggle="tooltip"]').tooltip()
        })
    </script>
@endsection