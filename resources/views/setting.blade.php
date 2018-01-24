@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#ubahPassword">Ubah Password</a></li>
                        <li><a data-toggle="tab" href="#editData">Edit Data</a></li>
                    </ul>

                  <div class="tab-content">
                    <div id="ubahPassword" class="tab-pane fade in active">
                        <br>
                        <form class="form-horizontal" method="POST" 
                            action="{{ route('ubahPassword', base64_encode(Auth::user()->id) ) }}">
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
                    <div id="editData" class="tab-pane fade">
                      <h3>Menu 2</h3>
                      <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
