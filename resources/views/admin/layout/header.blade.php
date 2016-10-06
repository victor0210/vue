<nav class="navbar" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                        aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a href="/admin" class="navbar-brand">DashBoard</a>
            </div>
            <div id="navbar" class="collapse navbar-collapse">
                <form class="navbar-form navbar-right">
                    <div class="form-group">
                        @if(Auth::check())
                            <a href="/user" class="text-primary">{{ Auth::user()->name }}</a>
                            <a href="/logout" type="submit" class="btn btn-default">Login out</a>
                        @else
                            <a href="/login" type="submit" class="btn btn-primary">Login</a>
                            <a href="/register" type="button" class="btn btn-default">Sign Up</a>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </nav>
