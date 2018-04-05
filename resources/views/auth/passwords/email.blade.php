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

input[type="submit"].login{
    float:right;
    height: 37px;
    -moz-border-radius: 19px;
    -webkit-border-radius: 19px;
    border-radius: 19px;
    -moz-background-clip: padding;
    -webkit-background-clip: padding-box;
    background-clip: padding-box;
    background-color: #55b1df;
    border:1px solid #55b1df;
    border:none;
    color: #fff;
    font-weight: bold;
}

input[type="submit"].login:hover{
    background-color: #fff; border:1px solid #55b1df; color:#55b1df; cursor:pointer;
}

input#email:focus{
    border-radius: 19px;
    border-color: #58bff6;
    color: #58bff6;
}

input#email{
    border-radius: 19px;
}

/*label[for="email"]{
    color:blue;
}*/

.ubahWarna{
    color: #58bff6;
}
</style>
@endsection

@section('content')
<p style="margin-top: 230px"></p>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"><center>Reset Password</center></div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form class="form-horizontal" method="POST" action="{{ route('password.email') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <!-- <button type="submit" class="btn btn-primary">
                                    Send Password Reset Link
                                </button> -->
                                <input type="submit" class="login pull-left" value="Send Password Reset Link"> 
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
    $(document).ready(function(){
    $('input').focus(function() {
        var label = $('label[for="' + $(this).attr('id') + '"]');
        label.addClass('ubahWarna');

        $(this).focusout(function() {
            var label = $('label[for="' + $(this).attr('id') + '"]');
            label.removeClass('ubahWarna');     
        });
    });

});
</script>
@endsection