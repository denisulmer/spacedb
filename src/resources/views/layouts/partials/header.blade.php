<nav>
    <div class="z-depth-4 nav-wrapper">
        <ul class="left hide-on-med-and-down" id="big-screen-navbar-left">
            <li><a href="{{ route('start') }}">{{ trans('navbar.start') }}</a></li>
            <li><a href="{{ route('discover') }}">{{ trans('navbar.discover') }}</a></li>
        </ul>
        <ul class="right hide-on-med-and-down">
            @if(Auth::check())
                <li><a href="{{ route('register') }}" href="#!" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ trans('navbar.logout') }}</a></li>
                <a class="waves-effect waves-light btn" href="{{ action('ImageController@create') }}"><i class="material-icons right">cloud_upload</i>{{ trans('navbar.upload') }}</a>
            @else
                <li><a href="{{ route('login') }}">{{ trans('navbar.sign_in') }}</a></li>
                <a class="waves-effect z-depth-4 btn" href="{{ route('register') }}"><i class="material-icons right">group_add</i>{{ trans('navbar.register') }}</a>
            @endif
        </ul>

        <!-- Small screen Navbar -->
        <ul class="left hide-on-large-only" id="nav-for-small-screens-left">
            <li><a href="{{ route('start') }}"><i class="material-icons">home</i></a></li>
            <li><a href="{{ route('discover') }}"><i class="material-icons">search</i></a></li>
        </ul>
        <ul class="right hide-on-large-only">
            @if(Auth::check())
                <li><a href="{{ route('register') }}" href="#!" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ trans('navbar.logout') }}</a></li>
                <a class="waves-effect waves-light btn" href="{{ action('ImageController@create') }}"><i class="material-icons">cloud_upload</i></a>
            @else
                <li><a href="{{ route('login') }}">{{ trans('navbar.sign_in') }}</a></li>
                <a class="waves-effect waves-light btn" href="{{ route('register') }}"><i class="material-icons">group_add</i></a>
            @endif
        </ul>
    </div>
</nav>