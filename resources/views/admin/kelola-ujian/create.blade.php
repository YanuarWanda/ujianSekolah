@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-primary">
                    <div class="panel-heading">Form Tambah Ujian</div>
                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" action="{{url('/kelola-ujian/create')}}">
                            {{csrf_field()}}

                            <div class="form-group{{ $errors->has('mapel') ? ' has-error' : '' }}">
                                <label for="mapel" class="col-md-4 control-label">Mata Pelajaran</label>

                                <div class="col-md-6">
                                    <select name="mapel" id="mapel" class="form-control">

                                            @foreach($mapel as $m)
                                                    <option @if(old('mapel') == $m->nama_mapel) {{ 'selected' }} @endif>{{ $m->nama_mapel }}</option>
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
                                    <input id="judul" type="text" class="form-control" name="judul" value="{{ old('judul') }}" required>

                                    @if ($errors->has('judul'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('judul') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('kkm') ? ' has-error' : '' }}">
                                <label for="kkm" class="col-md-4 control-label">Nilai KKM</label>

                                <div class="col-md-6">
                                    <input id="kkm" class="form-control" type="number" name="kkm" value="{{ old('kkm') }}" required/>

                                    @if($errors->has('kkm'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('kkm') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('waktu_pengerjaan') ? ' has-error' : '' }}">
                                <label for="waktu_pengerjaan" class="col-md-4 control-label">Waktu Pengerjaan</label>

                                <div class="col-md-6">
                                    <input id="waktu_pengerjaan" type="text" class="form-control timing" name="waktu_pengerjaan" value="{{ old('waktu_pengerjaan')}}" required>

                                    @if ($errors->has('waktu_pengerjaan'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('waktu_pengerjaan')}}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            {{-- Diganti jadi di post --}}
                            {{-- <div class="form-group{{ $errors->has('batas_pengerjaan') ? ' has-error' : '' }}">
                                <label for="batas_pengerjaan" class="col-md-4 control-label">Batas Pengerjaan</label>

                                <div class="col-md-6">
                                    <div class="input-group date" id="datetimepicker1">
                                        <input id="batas_pengerjaan" type="text" class="form-control" name="batas_pengerjaan" required/>
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
                            </div> --}}

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

                            <div class="form-group{{ $errors->has('lihat_nilai') ? ' has-error' : '' }}">
                                <label for="lihat_nilai" class="col-md-4 control-label">Siswa Lihat Nilai</label>

                                <div class="col-md-6">
                                    <select name="lihat_nilai" id="lihat_nilai" class="form-control">
                                        <option value="Y" {{ old('lihat_nilai') == 'Y' ? 'selected' : '' }} >Iya</option>
                                        <option value="N" {{ old('lihat_nilai') == 'N' ? 'selected' : '' }} >Tidak</option>
                                    </select>     

                                    @if ($errors->has('lihat_nilai'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('lihat_nilai') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div> 

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <a href="/kelola-ujian" class="btn btn-danger">Cancel</a>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-plus fa-1x"></i> Add
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
