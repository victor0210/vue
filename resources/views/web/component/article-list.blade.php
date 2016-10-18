<li class="list-group-item">
    <div class="row">
        <div class="col-md-12 article-list-title">
            <h2>
                <a href="content/{{ $item->id }}" class="text-gray">
                    {{$item->title}}
                </a>
            </h2>
        </div>
        <div class="col-md-12 article-list-content">
            {!!  $item->content !!}
        </div>
        <div class="col-md-12" style="color:#999;margin-bottom: 30px">
            {{--<span class="badge pull-left">Comments: {{ $item->comment_count }}</span>--}}
            {{--<span class="badge pull-right">Create: {{ $item->created_at }}</span>--}}
            <a href="" class="text-primary">{{ $item->user->name }}</a> ● {{ $item->created_at }}
        </div>
        {{--<div class="col-md-12">--}}
            {{--<span class="badge pull-right agreement">10</span> <span class="glyphicon glyphicon-thumbs-up pull-right" aria-hidden="true"></span>--}}
        {{--</div>--}}
    </div>
</li>