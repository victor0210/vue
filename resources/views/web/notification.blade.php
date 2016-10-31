@extends('layouts.app')

@section('tab',6)

@section('title', 'Notifications')

@section('content')
    <div class="row">
        <div class="col-sm-10  col-md-10 col-xs-12">
            <h2 class="page-header">
                <small>Notifications</small>
            </h2>
            @if(Auth::user()->notifications->count()>0)
                <ul class="list-group list-unstyled">
                    <form action="/notification" method="post">
                        @foreach(Auth::user()->notifications as $notification)
                            <li class="list-group-item">
                                <p><input type="checkbox" name="{{ $notification->id }}"
                                          value="{{ $notification->id }}">
                                    <label for="{{ $notification->id }}" style="display: initial;">
                                        @if($notification->type=='App\Notifications\Notify')
                                            [系统通知] :{{ $notification->data['content'] }}
                                        @elseif($notification->type='App\Notifications\Feedback')
                                            [{{ $notification->data['sender_name'] }} (
                                            id:{{ $notification->data['sender_id'] }} )]
                                            :{{ $notification->data['content'] }}
                                        @endif
                                    </label></p>
                                <p>
                                    <span class="badge">{{ $notification->created_at->timezone('Asia/Chongqing') }}</span>
                                </p>
                            </li>
                        @endforeach
                        <input type="submit" value="删除选中" class="btn btn-danger" style="margin-top: 20px">
                        <input type="button" value="全选" class="btn btn-warning choose-all" style="margin-top: 20px">
                        <input type="button" value="全不选" class="btn btn-primary choose-none" style="margin-top: 20px">
                    </form>
                </ul>
            @else
                <h4>
                    没有新通知
                    <small><a href="/article/all">返回博客公园</a></small>
                </h4>
            @endif
        </div>
    </div>

    <script>
        $(function () {
            $('.choose-all').click(function () {
                $('input[type=checkbox]').attr('checked', true);
            });
        })
    </script>
@endsection