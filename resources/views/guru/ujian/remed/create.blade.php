@extends('layouts.app')

@section('content')
@include('layouts/navbar/navbar_guru')
<div class="container text-dark">
    <div class="card mt-2 mb-2">
        <div class="card-header"><h1 class="text-center">Form Tambah Remed</h1></div>
        <div class="card-body">
            <form action="{{ url('guru/ujian/remed/add', base64_encode($ujian->id_ujian)) }}" method="POST">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="judul">Judul Ujian</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fas fa-id-badge fa-fw"></i></div>
                                </div>
                                <input type="text" name="judul" id="judul" class="form-control" value="{{ $ujian->judul_ujian }}" readonly="">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="mapel">Mata Pelajaran</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fas fa-book fa-fw"></i></div>
                                </div>
                                <input type="text" name="mapel" id="mapel" class="form-control" value="{{ $ujian->mapel->nama_mapel }}" readonly="">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="kkm">KKM</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fas fa-trophy fa-fw"></i></div>
                                </div>
                                <input type="text" name="kkm" id="kkm" class="form-control" value="{{ $ujian->kkm }}" readonly="">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="waktu_pengerjaan" class="col-form-label">Waktu Pengerjaan</label>
                            <input type="text" class="form-control timing" id="waktu_pengerjaan" name="waktu_pengerjaan" value="{{ old('waktu_pengerjaan') }}" required="">
                        </div>
                    </div>
                    <div class="col-lg-9">
                        <div class="form-group">
                            <label for="catatan">Catatan</label>
                            <textarea name="catatan" id="catatan" class="form-control" rows="4" required="">{{ old('catatan') }}</textarea>
                        </div>
                    </div>
                </div>
            
        </div>
        <div class="card-footer">
                <div class="btn-group btn-block">
                    <a href="{{ url('guru/ujian') }}" class="btn btn-danger btn-membesar" data-toggle="tooltip" data-placement="top" title="Kembali"><i class="fas fa-arrow-left"></i></a>
                    <button type="submit" class="btn btn-primary btn-membesar" data-toggle="tooltip" data-placement="top" title="Tambah Data Ujian Remed"><i class="fas fa-plus"></i></button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
$(document).ready(function(){
    $(".timing").timingfield({
        maxHour: 23,
        width: 263,
        hoursText: 'J',
        minutesText: 'M',
        secondsText: 'D'
    });
});
</script>
@endsection