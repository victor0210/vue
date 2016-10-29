<li class="list-group-item">
    <div class="row">
        <div class="col-md-10 col-xs-8 col-sm-9 article-list-title">
            <a href="/user/{{ $item->user->id }}" class="text-primary">{{ $item->user->name }}
                <span style="color:#999;margin-bottom: 30px">· {!! $item->created_at->diffForHumans() !!}</span>
            </a>
            <h4 style="margin:10px auto">
                <a href="/content/{{ $item->id }}" class="text-gray">
                    {{$item->title}}
                </a>
            </h4>
            <h6 style="color: #999999">
                浏览({{ $item->view }}) · 评论({{ $item->comment->count() }}) · 赞({{ $item->thumb_up }}) <span
                        class="badge">{{ $item->collection }}</span>
            </h6>
        </div>
        <div class="col-md-2 col-xs-4 col-sm-3">
            @if(!!$item->avatar)
                <img src="{!! $item->avatar[0] !!}" alt="" style="
            border: 1px solid #eeeeee;height: 90px;width: 90px;padding: 2px;border-radius: 5px;">
                @endif
        </div>
    </div>
</li>