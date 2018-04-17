@extends('layouts.app')

@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('css/login.css') }}">
@stop

@section('content')
<div class="limiter">
    <div class="container-login100">
        <div class="wrap-login100 p-t-50 p-b-90">
            <form class="form-horizontal login100-form flex-sb flex-w" method="POST" action="{{ route('password.email') }}">
                {{ csrf_field() }}
                <span class="login100-form-title p-b-51">
                    Reset Password
                </span>

                
                <div class="wrap-input100 validate-input m-b-16">
                    <input class="input100" type="email" name="email" placeholder="Email">
                    <span class="focus-input100"></span>
                </div>
                
                <div class="container-login100-form-btn m-t-17">
                    <button class="login100-form-btn" type="submit">
                        Send Password Reset Link
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection