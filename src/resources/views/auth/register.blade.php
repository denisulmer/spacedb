@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col xl8 offset-xl2 l12 m12 s12">
            <div class="card">
                <form action="{{ route('register') }}" method="post">
                    {{ csrf_field() }}

                    <div class="card-content">
                        <a class="hide-on-med-and-down right" id="login-using-google-button" href="{{ route('login.google') }}"><i class="fa fa-google"></i> {{ trans('login.with_google') }}</a>
                        <span class="card-title">{{ trans('register.title') }}</span>

                        @include('forms.errors')

                        <div class="row">
                            <div class="input-field col s12">
                                <input name="name" placeholder="{{ trans('register.name_placeholder') }}" class="{{ $errors->has('name') ? ' invalid' : '' }}" id="register-input-name" type="text">
                                <label for="register-input-name" class="active">{{ trans('register.name') }}</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <input name="email" placeholder="{{ trans('register.email_placeholder') }}" class="{{ $errors->has('email') ? ' invalid' : '' }}" id="register-input-email" type="email">
                                <label for="register-input-email" class="active">{{ trans('register.email') }}</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <input name="password" placeholder="{{ trans('register.password_placeholder') }}" id="register-input-password" autocomplete="new-password" class="{{ $errors->has('password') ? ' invalid' : '' }}" type="password">
                                <label for="register-input-password" class="active">{{ trans('register.password') }}</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <input name="password_confirmation" placeholder="{{ trans('register.password_confirmation_placeholder') }}" id="register-input-password-confirmation" autocomplete="new-password" class="{{ $errors->has('password_confirmation') ? ' invalid' : '' }}" type="password">
                                <label for="register-input-password-confirmation" class="active">{{ trans('register.password_confirmation') }}</label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col s12 m12 l6 xl6">
                                <button id="register-button" type="submit">{{ trans('register.button') }}</button>
                            </div>
                            <div class="col s12 m12 l6 xl6 hide-on-large-only center-align">
                                <a id="login-using-google-button" href="{{ route('login.google') }}"><i class="fa fa-google"></i> {{ trans('login.with_google') }}</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
