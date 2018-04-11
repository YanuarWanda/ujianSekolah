@extends('layouts.app')

@section('css')
<style type="text/css">
    body{
     background: url({{asset ('image/form-bg.jpg')}}) no-repeat center center fixed; 
    -webkit-background-size: cover;
    -moz-background-size: cover;
    -o-background-size: cover;
    background-size: cover;

}

/*.warnaBiru {
    color: #58bff6;
}*/

.ubahWarna {
    font-family:'HelveticaNeue','Times New Roman', sans-serif !important;
    color: #58bff6 !important;
    border-color: #58bff6 !important;
}

div.panel{
    /*border-radius: 50px;*/
    opacity: 0.95 !important;
}

input#username,#password{
    border-radius: 19px !important;
    padding-left: 20px !important;
}

input[type="submit"].login{
    float:left !important;
    width: 112px !important;
    height: 37px !important;
    -moz-border-radius: 19px !important;
    -webkit-border-radius: 19px !important;
    border-radius: 19px !important;
    -moz-background-clip: padding !important;
    -webkit-background-clip: padding-box !important;
    background-clip: padding-box !important;
    background-color: #55b1df !important;
    border:1px solid #55b1df !important;
    border:none !important;
    color: #fff !important;
    font-weight: bold !important;
}

input[type="submit"].login:hover{
    background-color: #fff !important; border:1px solid #55b1df !important; color:#55b1df !important; cursor:pointer !important;
}

input[type="submit"].login:focus{
    outline: none !important;
}


</style>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-6">
            <div class="panel panel-success">
                <div class="panel-heading"><center><h4>Login</h4></center></div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                            <label for="username" class="col-md-4 control-label">Username</label>

                            <div class="col-md-6">
                                <input id="username" type="text" class="form-control" name="username" value="{{ old('username') }}" required autofocus>

                                @if ($errors->has('username'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                 <input type="submit" class="login" value="Log In"> 
                                 
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    Forgot Your Password?
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script type="text/javascript">
// $('window').on('load', function(){
 //   $('.sidebar').hide();
// });
    $('#login').addClass('open');
$(document).ready(function(){
    $('input').focus(function() {
        var label = $('label[for="' + $(this).attr('id') + '"]');
        label.addClass('ubahWarna');
        var input = $('input[id="' +$(this).attr('id') + '"]');
        input.addClass('ubahWarna');

        $(this).focusout(function() {
            var label = $('label[for="' + $(this).attr('id') + '"]');
            label.removeClass('ubahWarna');     
            var input = $('input[id="' +$(this).attr('id') + '"]');
            input.removeClass('ubahWarna');       
        });
    });

});
</script>
@endsection