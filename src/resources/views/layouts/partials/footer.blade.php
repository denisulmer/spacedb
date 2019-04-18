<div class="container">
    <div class="row">
        <div class="col l6 s12">
            <h5 class="white-text">{{ trans('footer.settings') }}</h5>
            <div class="row">
                <div class="col s12 m6">
                    <ul>
                        <li><a class="grey-text" href="#">{{ trans('footer.settings_account') }}</a></li>
                        <li><a class="grey-text" href="#">{{ trans('footer.personal_statistics') }}</a></li>
                    </ul>
                </div>
                <div class="col s12 m6">
                    <ul>
                        <li><a class="grey-text" href="{{ route('equipment') }}">{{ trans('footer.settings_equipment') }}</a></li>
                        <li><a class="grey-text" href="#">{{ trans('footer.subscription') }}</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col l6 s12">
            <h5 class="white-text">{{ trans('footer.information') }}</h5>
            <div class="row">
                <div class="col s12 m6">
                    <ul>
                        <li><a class="grey-text" href="#!">{{ trans('footer.tos') }}</a></li>
                        <li><a class="grey-text" href="#!">{{ trans('footer.contact') }}</a></li>
                    </ul>
                </div>
                <div class="col s12 m6">
                    <ul>
                        <li><a class="grey-text" href="#!">{{ trans('footer.statistics') }}</a></li>
                    </ul>
                </div>
            </div>

        </div>
    </div>
</div>
<div class="footer-copyright">
    <div class="container">
        &copy; {{ date('Y') }} &mdash; Denis Ulmer
        @if (auth()->check())
            <span class="right">{{ trans('footer.logged_in_as', ['email' => auth()->user()->email]) }}</span>
        @else
            <span class="right hide-on-med-and-down">{{ trans('footer.not_logged_in') }} <a class="link" href="{{ route('login') }}">{{ trans('footer.login_link') }}</a>.</span>
        @endif
    </div>
</div>