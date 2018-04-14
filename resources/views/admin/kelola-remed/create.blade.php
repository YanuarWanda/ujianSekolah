@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-primary">
                    <div class="panel-heading">Form Tambah Remed</div>
                    <div class="panel-body">
                        <form class="form-horizontal" action="{{ url('/kelola-remed/create', base64_encode($ujian->id_ujian)) }}" id="bgst" method="POST">
                            {{csrf_field()}}

                            <div class="form-group">
                                <label for="ujian" class="col-md-4 control-label">Judul Ujian</label>

                                <div class="col-md-6">
                                    <input type="text" name="ujian" class="form-control" value="{{ $ujian->judul_ujian }}" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="mapel" class="col-md-4 control-label">Mata Pelajaran</label>

                                <div class="col-md-6">
                                    <select class="form-control" name="mapel" readonly>
                                        <option value="{{ $ujian->mapel->nama_mapel }}">{{ $ujian->mapel->nama_mapel }}</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="kkm" class="col-md-4 control-label">Nilai KKM</label>

                                <div class="col-md-6">
                                    <input type="number" name="kkm" class="form-control" value="{{ $ujian->kkm }}" readonly>
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('waktu_pengerjaan') ? ' has-error' : '' }}">
                                <label for="waktu_pengerjaan" class="col-md-4 control-label">Waktu Pengerjaan</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control timing" name="waktu_pengerjaan" value="{{ old('waktu_pengerjaan')}}" required>

                                    @if ($errors->has('waktu_pengerjaan'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('waktu_pengerjaan')}}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('catatan') ? ' has-error' : '' }}">
                                <label for="catatan" class="col-md-4 control-label">Catatan</label>

                                <div class="col-md-6">
                                    <textarea id="catatan" class="form-control" name="catatan" >{{ old('catatan') }}</textarea>

                                    @if ($errors->has('catatan'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('catatan') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <a href="/kelola-ujian" class="btn btn-danger">Cancel</a>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-plus fa-1x">Add</i>
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
  $('#ujian').addClass('active');
</script>
@endsection