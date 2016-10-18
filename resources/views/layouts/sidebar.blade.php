<div class="container sidenav-container">
    <div class="sidenav-info text-center">
        @if(Auth::check())
            <a href="/user"><img src="{{ Auth::user()->avatar_url }}"></a>
            <h2>{{ Auth::user()->name }}</h2>
            <h3>
                Here is some description of your own !
                Here is some description of your own !
            </h3>
        @else
            <h2>Welcome !</h2>
            <div class="btn-group">
                <a href="/login" class="btn btn-dark btn-lg">Login</a>
                <a href="/register" class="btn btn-default btn-lg">Sign up</a>
            </div>
        @endif
    </div>
    @if(Auth::check())
        @include('layouts.navbar')
    @endif
</div>