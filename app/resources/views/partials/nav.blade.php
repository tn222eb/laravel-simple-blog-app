<!-- Static navbar -->
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            {!! link_to_route('articles.index', 'MyBlog', [], ['class' => 'navbar-brand']) !!}
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            @if(Auth::check())
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a>Hi, <strong>{{Auth::user()->name}}</strong></a>
                    </li>

                    <li>
                        {!! link_to_route('articles.create', 'Create Article', [], []) !!}
                    </li>

                    <li>
                        <a href="{!! url('auth/logout') !!}">Logout</a>
                    </li>
                </ul>
            @else
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a>Hi, <strong>Guest</strong></a>
                    </li>

                    <li>
                        <a href="{!! url('auth/register') !!}">Register</a>
                    </li>

                    <li>
                        <a href="{!! url('auth/login') !!}">Login</a>
                    </li>
                </ul>
            @endif
        </div>
    </div>
</nav>