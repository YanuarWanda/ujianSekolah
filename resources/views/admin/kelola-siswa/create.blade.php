<!-- Ini Pendaftaran untuk Siswa -->
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-primary">
                <div class="panel-heading">Pendaftaran Siswa</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ url('/kelola-siswa/create') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('nis') ? ' has-error' : '' }}">
                            <label for="nis" class="col-md-4 control-label">Nomor Induk Siswa</label>

                            <div class="col-md-6">
                                <input id="nis" type="text" class="form-control" name="nis" value="{{ old('nis') }}" required autofocus>

                                @if ($errors->has('nis'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('nis') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('nama') ? ' has-error' : '' }}">
                            <label for="nama" class="col-md-4 control-label">Nama</label>

                            <div class="col-md-6">
                                <input id="nama" type="text" class="form-control" name="nama" value="{{ old('nama') }}" required>

                                @if ($errors->has('nama'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('nama') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('kelas') ? ' has-error' : '' }}">
                            <label for="kelas" class="col-md-4 control-label">Kelas</label>

                            <div class="col-md-6">
                                <select name="kelas" id="kelas" class="form-control">
                                    @foreach($kelas as $k)
                                        <option @if(old('kelas') == $k->nama_kelas) {{ 'selected' }} @endif>{{ $k->nama_kelas }}</option>
                                    @endforeach
                                </select>

                                @if ($errors->has('kelas'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('kelas') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('alamat') ? ' has-error' : '' }}">
                            <label for="alamat" class="col-md-4 control-label">Alamat</label>

                            <div class="col-md-6">
                                <textarea name="alamat" id="alamat" class="form-control" required>{{ old('alamat') }}</textarea>

                                @if ($errors->has('alamat'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('alamat') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('jenisKelamin') ? ' has-error' : '' }}">
                            <label for="jenisKelamin" class="col-md-4 control-label">Jenis Kelamin</label>

                            <div class="col-md-6">
                                <select name="jenisKelamin" id="jenisKelamin" class="form-control">
                                    <option value='L' {{ old('jenisKelamin') == 'L' ? 'selected' : '' }} >Laki-laki</option>
                                    <option value='P' {{ old('jenisKelamin') == 'P' ? 'selected' : '' }} >Perempuan</option>
                                </select>

                                @if ($errors->has('jenisKelamin'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('jenisKelamin') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!-- Untuk Foto, sementara dikomentar. Menunggu keputusan lebih lanjut, -->
                        <!-- Upload Foto saat register, atau nanti pas edit data. -->
                         <div class="form-group{{ $errors->has('foto') ? ' has-error' : '' }}">
                            <label for="foto" class="col-md-4 control-label">Foto</label>

                            <div class="col-md-6">
                                <img class="img-thumbnail" src="{{asset('image/nophoto.jpg')}}" id="profile-img-tag" width="200px" />
                                <input id="foto" type="file" name="foto" value="{{ old('foto') }}">

                                @if ($errors->has('foto'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('foto') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                            <label for="username" class="col-md-4 control-label">Username</label>

                            <div class="col-md-6">
                                <input id="username" type="text" class="form-control" name="username" value="{{ old('username') }}" required>

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
                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <a href="/kelola-siswa" class="btn btn-danger">Cancel</a>
                                <button type="submit" class="btn btn-primary">
                                    Register
                                </button>
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
    $('#kelola').addClass('active open');
  $('#siswa').addClass('active');
</script>
@endsection