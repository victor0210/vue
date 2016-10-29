<div class="container sidenav-container"
     @if(Auth::check())
     data-src="{{ Auth::user()->background_url }}"
     @else
     data-src="{{ elixir('images/bg15.jpg') }}"
        @endif
>
    <div class="floating" style="position: absolute;width: 100%;height: 100%;background-color: rgba(0,0,0,0.1)"></div>
    <span class="btn btn-link btn-lg glyphicon glyphicon-menu-hamburger toggle"></span>
    <div class="sidenav-info text-center">
        @if(Auth::check())
            <a href="/user"><img src="{{ Auth::user()->avatar_url }}"></a>
            <h1>{{ Auth::user()->name }}</h1>
            <h4 style="font-family: 'Playfair Display', serif">
                {{ Auth::user()->description }}
            </h4>
        @else
            <h1>Light Blog</h1>
            <h3>Share · Progress </h3>
            <h4>A place for Web-Engineer</h4>
        @endif
        <a href="/add-article" class="btn btn-lg btn-success">Get To Write <span class="fa fa-pencil"></span></a>
    </div>
</div>