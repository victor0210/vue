<div class="row">
    <nav class="navbar navbar-fixed-top" role="navigation">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav navbar-menu" data-tab="@yield('tab')">
                <li name="tab1"><a href="/article">Article</a></li>
                <li name="tab2"><a href="/music">Music</a></li>
                <li name="tab3"><a href="/about">About</a></li>
                @if(Auth::user()->is_admin)
                    <li><a href="/admin">Admin</a></li>
                @endif
            </ul>
            <ul class="nav navbar-nav pull-right">
                @if(Auth::check())
                    <li><a href="/logout"><span class="glyphicon glyphicon-log-out"></span></a></li>
                @endif
            </ul>
        </div>
    </nav>
</div>


<script>
    $('li[name=tab' + $('.navbar-menu').data('tab') + ']').addClass('active');
</script>