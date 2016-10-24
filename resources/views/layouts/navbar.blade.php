<div class="row">
    <nav class="navbar navbar-fixed-top" role="navigation">
        <div id="navbar">
            <ul class="nav navbar-nav navbar-menu" data-tab="@yield('tab')">
                <li name="tab0"><a href="/"><span class="glyphicon glyphicon-home"> Home</span></a></li>
                <li name="tab1"><a href="/article/all"><span class="glyphicon glyphicon-list-alt"> Article</span></a></li>
                <li name="tab2"><a href="/music"><span class="glyphicon glyphicon-headphones"> Music</span></a></li>
                <li name="tab3"><a href="/about"><span class="glyphicon glyphicon-globe"> About</span></a></li>
                <li><a href="/add-article"><span class="glyphicon glyphicon-pencil"> Writing</span></a></li>
                @if(!Auth::check())
                    <li name="tab3"><a href="/login"><span class="glyphicon glyphicon-log-in"> Login</span></a></li>
                    @endif
                @if(Auth::check())
                    <li name="tab4"><a href="/user"><span class="glyphicon glyphicon-user"> User</span></a></li>
                    <li name="tab5"><a href="/setting"><span class="glyphicon glyphicon-cog"> Setting</span></a></li>
                    @if(Auth::user()->is_admin)
                        <li><a href="/admin"><span class="glyphicon glyphicon-flash"> Admin</span></a></li>
                    @endif
                    <li><a href="/logout"><span class="glyphicon glyphicon-log-out"> LogOut</span></a></li>
                @endif
            </ul>
        </div>
    </nav>
</div>


<script>
    $('li[name=tab' + $('.navbar-menu').data('tab') + ']').addClass('active');
</script>