@extends('layouts.app')

@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('css/login.css') }}">
@stop

@section('content')
<div class="limiter">
    <div class="container-login100">
        <div class="wrap-login100 p-t-50 p-b-90">
            <form class="form-horizontal login100-form flex-sb flex-w" method="POST" action="{{ route('password.request') }}">
                {{ csrf_field() }}

                <span class="login100-form-title p-b-51">
                    U-LAH
                </span>

                <input type="hidden" name="token" value="{{ $token }}">

                <div class="wrap-input100 m-b-7 {{ $errors->has('email') ? ' has-error' : '' }}">
                    {{-- <label for="email" class="col-md-4 control-label">E-Mail Address</label> --}}
                    <input id="email" type="email" class="input100" name="email" value="{{ $email or old('email') }}" required autofocus placeholder="Email">

                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="wrap-input100 m-b-7 {{ $errors->has('password') ? ' has-error' : '' }}">
                    <input id="password" type="password" class="input100" name="password" required placeholder="Password">

                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="wrap-input100 m-b-7 {{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                    <input id="password-confirm" type="password" class="input100" name="password_confirmation" required placeholder="Confirm Password">

                    @if ($errors->has('password_confirmation'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="container-login100-form-btn m-t-17 p-b-15">
                    <button type="submit" class="login100-form-btn">
                        Reset Password
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
