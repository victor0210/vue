<li class="list-group-item">
    <div class="row">
        <div class="col-md-10 col-xs-8 col-sm-9 article-list-title">
            <a href="" class="text-primary">{{ $item->user->name }}
                <span style="color:#999;margin-bottom: 30px">· about {!! $item->created_at->diffForHumans() !!}</span>
            </a>
            <h4 style="margin:10px auto">
                <a href="/content/{{ $item->id }}" class="text-gray">
                    {{$item->title}}
                </a>
                <img src="" alt="">
            </h4>
            <h6 style="color: #999999">
                watch(20) · comment(30) · bingo(50) <span class="badge">{{ $item->collection }}</span>
            </h6>
        </div>
        <div class="col-md-2 col-xs-4 col-sm-3">
            <img src="{{ elixir('images/bg14.jpg') }}" alt="" style="
            border: 1px solid #eeeeee;height: 90px;width: 90px;padding: 2px;border-radius: 5px;">
        </div>
    </div>
</li>