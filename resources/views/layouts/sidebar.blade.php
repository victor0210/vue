<div class="container sidenav-container"
     @if(Auth::check())
     data-src="{{ Auth::user()->background_url }}"
     @else
     data-src="{{ elixir('images/bg9.jpg') }}"
        @endif
>
    <div class="floating" style="position: absolute;width: 100%;height: 100%;background-color: rgba(0,0,0,0.5)"></div>
    <div class="sidenav-info text-center">
        @if(Auth::check())
            <a href="/user"><img src="{{ Auth::user()->avatar_url }}"></a>
            <h1>{{ Auth::user()->name }}</h1>
            <h4 style="font-family: 'Playfair Display', serif">
                A modern blog theme, designed to optimize your reading experience as much as possible.
            </h4>
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