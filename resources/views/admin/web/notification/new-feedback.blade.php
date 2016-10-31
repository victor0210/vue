@extends('admin.layout.dashboard')
@section('page_heading','New Feedback')
@section('section')
    <div class="row">
        <div class="col-md-12">
            @if(Auth::user()->notifications->where('type','App\Notifications\Feedback')->count()>0)
                <ul class="list-group list-unstyled">
                    <form action="/notification" method="post">
                        @foreach(Auth::user()->notifications->where('type','App\Notifications\Feedback') as $notification)

                            <li class="list-group-item">
                                <p><input type="checkbox" name="{{ $notification->id }}"
                                          value="{{ $notification->id }}">
                                    <label for="{{ $notification->id }}" style="display: initial;">
                                         [ id : {{$notification->data['sender_id']}} ]
                                            :{{ $notification->data['content']}}
                                    </label></p>
                                <p>
                                    <span class="badge">{{ $notification->created_at->timezone('Asia/Chongqing') }}</span>
                                </p>
                            </li>
                        @endforeach
                        <input type="submit" value="删除选中" class="btn btn-danger" style="margin-top: 20px">
                        <input type="button" value="全选" class="btn btn-warning choose-all" style="margin-top: 20px">
                    </form>
                </ul>
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