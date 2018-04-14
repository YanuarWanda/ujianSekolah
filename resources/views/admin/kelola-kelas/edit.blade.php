@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-primary">
                <div class="panel-heading">Edit data Kelas</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ url('/kelola-kelas/update', base64_encode($data->id_kelas)) }}" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('nama_kelas') ? ' has-error' : '' }}">
                            <label for="nama_kelas" class="col-md-4 control-label">Nama Kelas</label>

                            <div class="col-md-6">
                                <input id="nama_kelas" type="text" class="form-control" name="nama_kelas" value="{{$data->nama_kelas}}" required autofocus placeholder="Contoh : XII RPL 1">

                                @if ($errors->has('nama_kelas'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('nama_kelas') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('jurusan') ? ' has-error' : '' }}">
                            <label for="jurusan" class="col-md-4 control-label">Pilih Jurusan</label>

                            <div class="col-md-6">
                                <select name="jurusan" id="jurusan" class="form-control">
                                    @foreach($jurusan as $d)
                                        <option  @if($d->id_jurusan == $data->id_jurusan) {{ 'selected' }} @endif>
                                            {{ $d->nama_jurusan }}
                                        </option>
                                    @endforeach
                                </select>

                                @if ($errors->has('jurusan'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('jurusan') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <a href="/kelola-kelas" class="btn btn-danger">Cancel</a>
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

@section('js')
<script type="text/javascript">
    $('#kelola').addClass('active open');
  $('#kelas').addClass('active');
</script>
@endsection