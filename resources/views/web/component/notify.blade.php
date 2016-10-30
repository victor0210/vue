@if(Auth::check()&&Auth::user()->unreadNotifications->count()>0 )
    <div style="position:absolute;right: 2%;top: 2%;" data-toggle="tooltip" data-placement="left"
         title="{{ Auth::user()->unreadNotifications->count() }} 条新通知">
        <a href="/notification"><span class="badge"><span class="glyphicon glyphicon-bullhorn"></span> {{ Auth::user()->unreadNotifications->count()  }}</span></a>
    </div>
@endif

<script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })
</script>