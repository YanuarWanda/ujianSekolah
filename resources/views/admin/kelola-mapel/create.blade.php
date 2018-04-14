@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-primary">
                <div class="panel-heading">Tambahkan Mata Pelajaran</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ url('/kelola-mapel/create') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('nama_mapel') ? ' has-error' : '' }}">
                            <label for="nama_mapel" class="col-md-4 control-label">Nama Pelajaran</label>

                            <div class="col-md-6">
                                <input id="nama_mapel" type="text" class="form-control" name="nama_mapel" value="{{ old('nama_mapel') }}" required autofocus>

                                @if ($errors->has('nama_mapel'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('nama_mapel') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('bidang_keahlian') ? ' has-error' : '' }}">
                            <label for="bidang_keahlian" class="col-md-4 control-label">Pilih Bidang Keahlian</label>
                            <div class="col-md-6">
                                <select name="bidang_keahlian" id="bidang_keahlian" class="form-control">
                                    @foreach($daftar_bidang_keahlian as $d)
                                        <option @if(old('daftar_bidang_keahlian') == $d->bidang_keahlian) {{ 'selected' }} @endif>{{ $d->bidang_keahlian }}</option>
                                    @endforeach
                                </select>
                                    @if ($errors->has('daftar_bidang_keahlian'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('daftar_bidang_keahlian') }}</strong>
                                        </span>
                                    @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <a href="/kelola-mapel" class="btn btn-danger">Cancel</a>
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
  $('#mapel').addClass('active');
</script>
@endsection