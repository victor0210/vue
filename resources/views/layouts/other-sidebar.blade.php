<div class="container sidenav-container"
     data-src="{{ $user->background_url }}"
>
    <div class="floating" style="position: absolute;width: 100%;height: 100%;background-color: rgba(0,0,0,0.1)"></div>
    <span class="btn btn-link btn-lg glyphicon glyphicon-menu-hamburger toggle"></span>
    <div class="sidenav-info text-center">
        <a href="/user"><img src="{{ $user->avatar_url }}"></a>
        <h1>{{ $user->name }}</h1>
        <h4 style="font-family: 'Playfair Display', serif">
            {{ $user->description }}
        </h4>
        <a href="/add-article" class="btn btn-lg btn-success">Get To Write</a>
    </div>
</div>