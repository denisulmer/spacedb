<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @if(Auth::check())
        <meta name="user_id" content="{{ auth()->user()->id }}">
        <meta name="astrometry_jobs_count" content="{{ auth()->user()->astrometryJobs()->running()->count() }}">
    @endif

    <title>{{ config('app.name') }} {{ config('app.version') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Fresca|Muli|Noto+Sans|Slabo+27px" rel="stylesheet">
</head>
<body>

<!-- Header & Nav -->
<header>
    @include('layouts.partials.header', ['sidebar' => true])
</header>

<!-- Page Body -->
<main>
    <div class="container">
        @yield('content')
    </div>
</main>

<!-- Footer -->
<footer class="page-footer">
    @include('layouts.partials.footer')
</footer>

<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    {{ csrf_field() }}
</form>

<!-- Modals -->
@stack('modals')

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
@stack('scripts')

<!-- Toasts -->
@if(Session::has('toast'))
    <script type="text/javascript">
        var undoAction = '{{ Session::get('toast-undo') }}';
        if (undoAction.length > 0) {
            Materialize.toast("{{ Session::get('toast') }} <a href='{{ Session::get('toast-undo') }}' class='toast-action black-text right'>{{ trans('misc.undo') }}</span>", "{{ config('app.toast-duration', 4000) }}", "{{ Session::get('toast-class') }}");
        } else {
            Materialize.toast("{{ Session::get('toast') }}", "{{ config('app.toast-duration', 4000) }}", "{{ Session::get('toast-class') }}");
        }
    </script>
@endif
</body>
</html>