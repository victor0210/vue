@if(Auth::check())
    @if((Auth::user()->unreadNotifications->where('type','App\Notifications\Comments')->count()>0||Auth::user()->unreadNotifications->where('type','App\Notifications\Thumb')->count()>0)||Auth::user()->unreadNotifications->where('type','App\Notifications\Notify')->count()>0 )
        <div style="position:absolute;right: 2%;top: 2%;" data-toggle="tooltip" data-placement="left"
             title="{{ Auth::user()->unreadNotifications->where('type','App\Notifications\Comments')->count()||Auth::user()->unreadNotifications->where('type','App\Notifications\Notify')->count()+Auth::user()->unreadNotifications->where('type','App\Notifications\Thumb')->count() }} 条新通知">
            <a href="/notification"><span class="badge"><span
                            class="glyphicon glyphicon-bullhorn"></span>{{ Auth::user()->unreadNotifications->where('type','App\Notifications\Comments')->count()+Auth::user()->unreadNotifications->where('type','App\Notifications\Notify')->count()+Auth::user()->unreadNotifications->where('type','App\Notifications\Thumb')->count() }}</span></a>
        </div>
    @endif
@endif

<script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })
</script>