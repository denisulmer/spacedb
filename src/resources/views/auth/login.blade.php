@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col xl8 offset-xl2 l12 m12 s12">
            <div class="card">
                <form action="{{ route('login') }}" method="post">
                    {{ csrf_field() }}

                    <div class="card-content">
                        <a class="hide-on-med-and-down right" id="login-using-google-button" href="{{ route('login.google') }}"><i class="fa fa-google"></i> {{ trans('login.with_google') }}</a>
                        <span class="card-title">{{ trans('login.title') }}</span>

                        @include('forms.errors')

                        <div class="row">
                            <div class="input-field col s12">
                                <input name="email" placeholder="{{ trans('login.email_placeholder') }}" id="login-input-email" type="email" class="{{ $errors->has('email') ? ' invalid' : '' }}" value="{{ old('email', '') }}">
                                <label for="login-input-email" class="active">{{ trans('login.email') }}</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <input name="password" placeholder="{{ trans('login.password_placeholder') }}" id="login-input-password" autocomplete="new-password" class="{{ $errors->has('password') ? ' invalid' : '' }}" type="password">
                                <label for="login-input-password" class="active">{{ trans('login.password') }}</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col s12 m12 l6 xl6">
                                <button id="login-button" type="submit">{{ trans('login.button') }}</button>
                            </div>
                            <div class="col s12 m12 l6 xl6">
                                <a id="reset-password-button" href="{{ route('password.request') }}">{{ trans('passwords.forgot') }}</a>
                            </div>
                            <div class="col s12 m12 l6 xl6 hide-on-large-only center-align" style="margin-top: 10px;">
                                <a class="chip  z-depth-1" href="{{ route('login.google') }}"><i class="fa fa-google"></i> {{ trans('login.with_google') }}</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
