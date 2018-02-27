@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-primary">
                <div class="panel-heading">Edit data Jurusan</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ url('/kelola-jurusan/update', base64_encode($data->id_jurusan)) }}" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('nama_jurusan') ? ' has-error' : '' }}">
                            <label for="nama_jurusan" class="col-md-4 control-label">Nama Jurusan</label>

                            <div class="col-md-6">
                                <input id="nama_jurusan" type="text" class="form-control" name="nama_jurusan" value="{{ $data->nama_jurusan }}" required autofocus>

                                @if ($errors->has('nama_jurusan'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('nama_jurusan') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <a href="/kelola-jurusan" class="btn btn-danger">Cancel</a>
                                <button type="submit" class="btn btn-primary">
                                    Save
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
