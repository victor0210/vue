<div class="row">
    <nav class="navbar navbar-fixed-top" role="navigation">
        <div id="navbar">
            <ul class="nav navbar-nav navbar-menu" data-tab="@yield('tab')">
                <li name="tab1"><a href="/article/all"><span class="glyphicon glyphicon-list-alt"> 博客公园</span></a></li>
                <li name="tab0"><a href="/"><span class="glyphicon glyphicon-home"> 推荐分类</span></a></li>
                <li name="tab2"><a href="/recommend"><span class="glyphicon glyphicon-headphones"> 风云人物</span></a></li>
                @if(!Auth::check())
                    <li><a href="/login"><span class="glyphicon glyphicon-log-in"> 登录</span></a></li>
                @endif
                @if(Auth::check())
                    <li name="tab4"><a href="/user"><span class="glyphicon glyphicon-user"> 个人中心</span></a></li>
                    <li name="tab5"><a href="/setting"><span class="glyphicon glyphicon-cog"> 个性设置</span></a></li>
                    @if(Auth::user()->is_admin)
                        <li><a href="/admin"><span class="glyphicon glyphicon-flash"> 管理大大</span></a></li>
                    @endif
                    <li><a href="/logout"><span class="glyphicon glyphicon-log-out"> 注销登录</span></a></li>
                @endif
                <li name="tab3"><a href="/about"><span class="glyphicon glyphicon-qrcode"> 关于我们</span></a></li>
            </ul>
        </div>
    </nav>
</div>


<script>
    $('li[name=tab' + $('.navbar-menu').data('tab') + ']').addClass('active');
</script>