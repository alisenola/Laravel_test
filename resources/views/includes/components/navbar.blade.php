<header class="d-flex justify-content-between p-2">
    <div>
        <h4><a href="{{ route('home') }}">Laravel TEST</a></h4>
    </div>
    <div id="headerLinks">
        @auth
        <a href="{{ route('logout') }}"><i class="fas fa-sign-out-alt"></i> Logout</a>
        <a href=""><img src="{{ auth()->user()->avatar }}" width="35px"
                class="me-1" />{{ auth()->user()->username }}</a>
        @else
        <a href="{{ route('login') }}"><i class="fas fa-key"></i> Sign in</a>
        <a href="{{ route('register') }}"><i class="fas fa-key"></i> Sign up</a>
        @endauth
    </div>
</header>