<li class="list-group-item">
    <div class="row">
        <div class="col-md-3 col-sm-3">
            <div class="thumbnail">
                <div class="jumbotron">
                    <img src=" {{ $item->user->avatar_url }} ">
                </div>
            </div>
        </div>
        <div class="col-md-9 col-sm-9 article-list-title">
            <a href="content/{{ $item->id }}">
                {{$item->title}}
            </a>
        </div>
        <div class="col-md-9 article-list-content">
            {!!  $item->content !!}
        </div>
        <div class="col-md-9">
            <span class="badge pull-left">Comments: {{ $item->comment_count }}</span>
            <span class="badge pull-right">Create: {{ $item->created_at }}</span>
        </div>
    </div>
</li>