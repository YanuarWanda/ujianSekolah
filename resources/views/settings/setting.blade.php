@extends('layouts.app')

@section('css')
<link href="{{ asset('css/bootstrap-select.min.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Settings Menu</div>

                <div class="panel-body">
                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#ubahPassword">Ubah Password</a></li>

                        @if (Auth::user()->hak_akses=='siswa' || Auth::user()->hak_akses=='guru') <li><a data-toggle="tab" href="#editData">Edit Data</a></li>@endif
                    </ul>

                  <div class="tab-content">
                    <div id="ubahPassword" class="tab-pane fade in active">
                        <br>
                        <form class="form-horizontal" method="POST"
                            action="{{ route('ubahPassword', base64_encode(Auth::user()->id_users) ) }}">
                            {{ csrf_field() }}

                            {{-- Password lama --}}
                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password" class="col-md-4 control-label">Password Baru</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" name="password" required>

                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            {{-- Password baru --}}
                            {{-- <div class="form-group{{ $errors->has('passwordBaru') ? ' has-error' : '' }}">
                                <label for="passwordBaru" class="col-md-4 control-label">New Password</label>

                                <div class="col-md-6">
                                    <input id="passwordBaru" type="password" class="form-control" name="passwordBaru" required>

                                    @if ($errors->has('passwordBaru'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('passwordBaru') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div> --}}

                            {{-- Konfirmasi Password baru --}}
                            <div class="form-group">
                                <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                </div>
                            </div>

                            <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-danger pull-right">
                                    Ubah
                                </button>
                            </div>
                        </div>
                        </form>
                    </div>
                    @if(Auth::user()->hak_akses == 'siswa' || Auth::user()->hak_akses=='guru')
                    <div id="editData" class="tab-pane fade">
                        <br>
                      @if(Auth::user()->hak_akses == 'siswa')
                        @include('settings.siswa')
                      @elseif(Auth::user()->hak_akses == 'guru')
                        @include('settings.guru')
                      @endif
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection

@section('js')
<script type="text/javascript" src="{{ asset('js/bootstrap-select.min.js') }}"></script>
@endsection
