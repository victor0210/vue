<style>
    .navbar-toggle .icon-bar{
        background: #337ab7;
    }
</style>

<div class="container">
    <nav class="navbar" role="navigation">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a href="/" class="navbar-brand">Home</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li><a href="/article">Article</a></li>
                <li><a href="/music">Music</a></li>
            </ul>
            <form class="navbar-form navbar-right">
                <div class="form-group">
                    @if(Auth::check())
                        <a href="/user" style="margin-right: 30px;text-decoration: none">
                            <img src="{{ Auth::user()->avatar_url }}" width="40px">
                        </a>
                        <a href="/logout" type="submit" class="btn btn-danger">Login out</a>
                    @else
                        <a href="/login" type="submit" class="btn btn-primary">Login</a>
                        <a href="/register" type="button" class="btn btn-default">Sign Up</a>
                    @endif
                </div>
            </form>
        </div>
    </nav>
</div>
