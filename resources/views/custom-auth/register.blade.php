@extends('layouts.app')

@section('css')
{{-- <link rel="stylesheet" type="text/css" href="{{ asset('css/login.css') }}"> --}}
<style type="text/css">
body { 
  background: url({{ asset('image/bg.jpg') }}) no-repeat center center fixed; 
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
}
</style>
@stop

@section('content')
<form method="POST" action="{{ route('register') }}">
{{ csrf_field() }}
<div class="container row">
    <div class="col-md-12">
        <div class="jumbotron">
            <h2>Registrasi Siswa</h2>
        </div>
    </div>
    <div class="col-md-4">
        <div class="panel panel-default">
            <div class="panel-body">
                <legend>Biodata</legend>

                <div class="form-group{{ $errors->has('nis') ? ' has-error' : '' }}">
                    <label for="nis" class="control-label">Nomor Induk Siswa</label>
                    <input id="nis" type="text" class="form-control" name="nis" value="{{ old('nis') }}" required autofocus>

                    @if ($errors->has('nis'))
                        <span class="help-block">
                            <strong>{{ $errors->first('nis') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('nama') ? ' has-error' : '' }}">
                    <label for="nama" class="control-label">Nama</label>
                    <input id="nama" type="text" class="form-control" name="nama" value="{{ old('nama') }}" required>

                    @if ($errors->has('nama'))
                        <span class="help-block">
                            <strong>{{ $errors->first('nama') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('jenisKelamin') ? ' has-error' : '' }}">
                    <label for="jenisKelamin" class="control-label">Jenis Kelamin</label>
                    <select name="jenisKelamin" id="jenisKelamin" class="form-control">
                        <option value='L'>Laki-laki</option>
                        <option value='P'>Perempuan</option>
                    </select>

                    @if ($errors->has('jenisKelamin'))
                        <span class="help-block">
                            <strong>{{ $errors->first('jenisKelamin') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('alamat') ? ' has-error' : '' }}">
                    <label for="alamat" class="control-label">Alamat</label>

                    <textarea name="alamat" id="alamat" class="form-control" required>
                        {{ old('alamat') }}
                    </textarea>

                    @if ($errors->has('alamat'))
                        <span class="help-block">
                            <strong>{{ $errors->first('alamat') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="panel panel-default">
            <div class="panel-body">
                <legend>Akun</legend>

                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="email" class=" control-label">E-Mail</label>
                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                    <label for="username" class=" control-label">Username</label>
                    <input id="username" type="text" class="form-control" name="username" value="{{ old('username') }}" required>

                    @if ($errors->has('username'))
                        <span class="help-block">
                            <strong>{{ $errors->first('username') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <label for="password" class=" control-label">Password</label>
                    <input id="password" type="password" class="form-control" name="password" required>

                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="password-confirm" class="control-label">Confirm Password</label>
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                </div>

                <br>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="container-fluid row">
            <div class="col-md-12 panel panel-default">
                <div class="panel-body">
                    <legend>Kelas</legend>

                    <div class="form-group{{ $errors->has('kelas') ? ' has-error' : '' }}">
                        {{-- <label for="kelas" class="control-label">Kelas</label> --}}
                        <select name="kelas" id="kelas" class="form-control">
                            <option disabled selected>Pilih Kelas</option>
                            <option>XII RPL 1</option>
                            <option>XII RPL 2</option>
                            <option>XII RPL 3</option>
                            <option>XII MM 1</option>
                            <option>XII MM 2</option>
                            <option>XII TKJ</option>
                        </select>

                        @if ($errors->has('kelas'))
                            <span class="help-block">
                                <strong>{{ $errors->first('kelas') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-md-12 panel panel-default">
                <div class="panel-body">
                    <button type="submit" class="btn btn-primary btn-block">
                        Submit
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
</form>
@endsection