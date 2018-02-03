@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-primary">
                    <div class="panel-heading">Form Edit Ujian</div>
                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" action="{{url('/kelola-ujian/update', base64_encode($ujian->id_ujian))}}">
                            {{csrf_field()}}

                            <div class="form-group{{ $errors->has('mapel') ? ' has-error' : '' }}">
                                <label for="mapel" class="col-md-4 control-label">Mata Pelajaran</label>

                                <div class="col-md-6">
                                    <select name="mapel" id="mapel" class="form-control">
                                        @foreach($mapel as $m)
                                            <option value="{{ $m->id_mapel }}" @if($m->id_mapel == $ujian->id_mapel || old('mapel') == $m->nama_mapel) {{ 'selected' }} @endif>{{ $m->nama_mapel }}</option>
                                        @endforeach
                                    </select>

                                    @if ($errors->has('mapel'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('mapel') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('judul') ? ' has-error' : '' }}">
                                <label for="judul" class="col-md-4 control-label">Judul Ujian</label>

                                <div class="col-md-6">
                                    <input id="judul" type="text" class="form-control" name="judul" value="{{ $ujian->judul_ujian }}" required>

                                    @if ($errors->has('judul'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('judul') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('waktu_pengerjaan') ? ' has-error' : '' }}">
                                <label for="waktu_pengerjaan" class="col-md-4 control-label">Waktu Pengerjaan</label>

                                <div class="col-md-6">
                                    <input id="waktu_pengerjaan" type="text" class="form-control timing" name="waktu_pengerjaan" value="{{ $wp }}" required>

                                    @if ($errors->has('waktu_pengerjaan'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('waktu_pengerjaan')}}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('batas_pengerjaan') ? ' has-error' : '' }}">
                                <label for="batas_pengerjaan" class="col-md-4 control-label">Batas Pengerjaan</label>

                                <div class="col-md-6">
                                    <div class="input-group date" id="datetimepicker1">
                                        <input id="batas_pengerjaan" type="text" class="form-control" name="batas_pengerjaan" value="{{ $ujian->tanggal_kadaluarsa }}" required/>
                                        <span class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </span>
                                    </div>

                                    @if ($errors->has('batas_pengerjaan'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('batas_pengerjaan')}}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('catatan') ? ' has-error' : '' }}">
                                <label for="catatan" class="col-md-4 control-label">Catatan</label>

                                <div class="col-md-6">
                                    <textarea id="catatan" class="form-control" name="catatan" >{{ $ujian->catatan }}</textarea>

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
                                        Update
                                    </button>
                                    <a href="{{url('/kelola-soal/create', base64_encode($ujian->id_ujian))}}" class="btn btn-primary pull-right">Add Soal</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
