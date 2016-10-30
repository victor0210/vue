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
                            @foreach($notification->data as $data)
                                <li class="list-group-item"><input type="checkbox" name="{{ $notification->id }}"
                                                                   value="{{ $notification->id }}">
                                    <label for="{{ $notification->id }}" style="display: initial;">
                                        [系统通知] {{ $data }} <span
                                                class="badge pull-right">{{ $notification->created_at->timezone('Asia/Chongqing') }}</span>
                                    </label>
                                </li>
                            @endforeach
                        @endforeach
                        <input type="submit" value="Delete" class="btn btn-danger" style="margin-top: 20px">
                    </form>
                </ul>
            @else
                <h4>
                    没有新通知 <small><a href="/article/all">返回博客公园</a></small>
                </h4>
            @endif
        </div>
    </div>
@endsection