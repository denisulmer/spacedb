@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col xl8 offset-xl2 l12 m12 s12">
            <div class="card">
                <form action="{{ route('password.email') }}" method="post">
                    {{ csrf_field() }}

                    <div class="card-content">
                        <span class="card-title">{{ trans('passwords.email') }}</span>

                        @include('forms.errors')

                        <div class="row">
                            <div class="input-field col s12">
                                <input name="email" placeholder="{{ trans('register.email_placeholder') }}" class="{{ $errors->has('email') ? ' invalid' : '' }}" id="register-input-email" type="email">
                                <label for="register-input-email" class="active">{{ trans('register.email') }}</label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col s12 m12 l6 xl6">
                                <button id="register-button" type="submit">{{ trans('auth.request-password-button') }}</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection