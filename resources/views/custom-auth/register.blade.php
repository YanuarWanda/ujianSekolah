<!-- Ini Pendaftaran untuk Siswa -->
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card my-2">
                <div class="card-header bg-primary">Pendaftaran Siswa</div>

                <div class="card-block">
                    <form class="my-3" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}

                        <div class="form-group row{{ $errors->has('foto') ? ' has-error' : ''}}">
                            <label for="foto" class="col-md-3 offset-md-1 form-control-label my-1">Foto Profil</label>
                            <div class="col-md-6">
                                <img class="img-thumbnail offset-md-2" id="profile-img-tag" src="#" width="250px">
                                <div class="custom-file my-1">
                                  <input type="file" name="file" id="profile-img" class="custom-file-input">
                                  <label class="custom-file-label" for="customFile">Pilih file</label>
                                </div>
                                @if ($errors->has('foto'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('foto') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                       <div class="form-group row{{ $errors->has('nis') ? ' has-error' : '' }}">
                            <label for="nis" class="col-md-3 offset-md-1 form-control-label my-1">Nomor Induk Siswa</label>

                            <div class="col-md-6">
                                <input id="nis" type="text" class="form-control" name="nis" value="{{ old('nis') }}" required autofocus>

                                @if ($errors->has('nis'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('nis') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row{{ $errors->has('nama') ? ' has-error' : '' }}">
                            <label for="nama" class="col-md-3 offset-md-1 form-control-label my-1">Nama</label>

                            <div class="col-md-6">
                                <input id="nama" type="text" class="form-control" name="nama" value="{{ old('nama') }}" required>

                                @if ($errors->has('nama'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('nama') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row{{ $errors->has('kelas') ? ' has-error' : '' }}">
                            <label for="kelas" class="col-md-3 offset-md-1 form-control-label my-1">Kelas</label>

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

                        <div class="form-group row{{ $errors->has('alamat') ? ' has-error' : '' }}">
                            <label for="alamat" class="col-md-3 offset-md-1 form-control-label my-1">Alamat</label>

                            <div class="col-md-6">
                                <textarea name="alamat" id="alamat" class="form-control" required>{{ old('alamat') }}</textarea>

                                @if ($errors->has('alamat'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('alamat') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row{{ $errors->has('jurusan') ? ' has-error' : '' }}">
                            <label for="jurusan" class="col-md-3 offset-md-1 form-control-label my-1">Jurusan</label>

                            <div class="col-md-6">
                                <input id="jurusan" type="text" class="form-control" name="jurusan" value="{{ old('jurusan') }}" required>

                                @if ($errors->has('jurusan'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('jurusan') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row{{ $errors->has('jenisKelamin') ? ' has-error' : '' }}">
                            <label for="jenisKelamin" class="col-md-3 offset-md-1 form-control-label my-1">Jenis Kelamin</label>

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

                        <div class="form-group row{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-3 offset-md-1 form-control-label my-1">E-Mail</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row{{ $errors->has('username') ? ' has-error' : '' }}">
                            <label for="username" class="col-md-3 offset-md-1 form-control-label my-1">Username</label>

                            <div class="col-md-6">
                                <input id="username" type="text" class="form-control" name="username" value="{{ old('username') }}" required>

                                @if ($errors->has('username'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-3 offset-md-1 form-control-label my-1">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-3 offset-md-1 form-control-label my-1">Confirm Password</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-control-md">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary float-sm-right">
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
