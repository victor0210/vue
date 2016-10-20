<li class="list-group-item">
    <div class="row">
        <div class="col-md-12 article-list-title">
            <h2>
                <a href="/content/{{ $item->id }}" class="text-gray">
                    {{$item->title}}
                </a>
            </h2>
        </div>
        <div class="col-md-12 article-list-content">
            {!!  $item->content !!}
        </div>
        <div class="col-md-12" style="color:#999;margin-bottom: 30px">
            <a href="" class="text-primary">{{ $item->user->name }}</a> ● {{ $item->created_at->setTimeZone('Asia/Chongqing')->format('y-m-d') }}
        </div>
    </div>
</li>