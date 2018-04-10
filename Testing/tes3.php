@extends('layouts.app')
@section('css')
<style type="text/css">
    body{
     background: url({{asset ('image/form-bg.jpg')}}) no-repeat center center fixed; 
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
  font-family:'HelveticaNeue','Arial', sans-serif;

}

div.panel-heading{
    font-family:'HelveticaNeue','Times New Roman', sans-serif;
    font-size: 20px;
}

div#form{
    position: absolute;
    width:360px;
    height:320px;
    height:auto;
    background-color: #fff;
    margin:auto;
    border-radius: 5px;
    /*padding:20px;*/
    left:50%;
    top:50%;
    margin-left:180px;
    margin-top:-200px;
}
div.form-item{position: relative; display: block; margin-bottom: 20px;}
 input{transition: all .2s ease;}
 input.form-style{
    color:#8a8a8a;
    display: block;
    width: 90%;
    height: 44px;
    padding: 5px 5%;
    border:1px solid #ccc;
    -moz-border-radius: 27px;
    -webkit-border-radius: 27px;
    border-radius: 27px;
    -moz-background-clip: padding;
    -webkit-background-clip: padding-box;
    background-clip: padding-box;
    background-color: transparent;
    font-family:'HelveticaNeue','Times New Roman', sans-serif;
    font-size: 105%;
    letter-spacing: .8px;
}
div.form-item .form-style:focus{outline: none; border:1px solid #58bff6; color:#58bff6; }
div.form-item p.formLabel {
    position: absolute;
    left:26px;
    top:10px;
    transition:all .4s ease;
    color:#ccc;}
.formTop{top:-10px !important; left:26px; background-color: #fff; padding:0 5px; font-size: 14px; color:#58bff6 !important;}
.formStatus{color:#8a8a8a !important;}
input[type="submit"].login{
    float:right;
    width: 112px;
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
input[type="submit"].login:hover{background-color: #fff; border:1px solid #55b1df; color:#55b1df; cursor:pointer;}
input[type="submit"].login:focus{outline: none;}

</style>
@endsection

@section('content')   
<script src="https://code.jquery.com/jquery-2.1.0.min.js" ></script>
<body>
    <div class="panel panel-success" id="form">
        <div class="panel-heading">Login</div>
            <div class="panel-body">
                <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                                {{ csrf_field() }}
                <div class="form-item {{ $errors->has('username') ? ' has-error' : '' }}">
                    <p class="formLabel">Username</p>
                        <input type="text" name="username" id="username" class="form-style" value="{{ old('username') }}" required/>
                        @if ($errors->has('username'))
                            <span class="help-block">
                                <strong>{{ $errors->first('username') }}</strong>
                            </span>
                        @endif
                </div>
                <div class="form-item {{ $errors->has('password') ? ' has-error' : '' }}">
                    <p class="formLabel">Password</p>
                        <input type="password" name="password" id="password" class="form-style" required/>
                         @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif               
                </div>
                <div class="form-item">
                        <input type="submit" class="login pull-left" value="Log In"> 
                        <a class="btn btn-link" href="{{ route('password.request') }}">Forgot Your Password?</a>
                </div>
            </form>
        </div>
    </div>
</body>
@endsection

@section('js')
<script type="text/javascript">
    $(document).ready(function(){
    var formInputs = $('input[type="text"],input[type="password"]');
    formInputs.focus(function() {
       $(this).parent().children('p.formLabel').addClass('formTop');
    });
    formInputs.focusout(function() {
        if ($.trim($(this).val()).length == 0){
        $(this).parent().children('p.formLabel').removeClass('formTop');
        }
    });
    $('p.formLabel').click(function(){
         $(this).parent().children('.form-style').focus();
    });
});
</script>
@endsection