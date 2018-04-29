@extends('layouts/app')

@section('content')
@include('layouts/navbar/navbar_admin')
<div class="container text-dark">
    <h1 class="text-center">Form Tambah Ujian</h1>
    <form action="{{ url('ujian/add') }}" method="POST" id="formTambahUjian">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="mapel" class="col-form-label">Mata Pelajaran</label>
            <select name="mapel" id="mapel" class="form-control">
                @foreach($mapel as $m)
                    <option value="{{ $m->id_mapel }}" @if(old('mapel') == $m->id_mapel) selected @endif>{{ $m->nama_mapel }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="judul" class="col-form-label">Judul Ujian</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fas fa-id-badge"></i></div>
                </div>
                <input type="text" class="form-control" id="judul" name="judul" placeholder="Masukkan judul ujian" value="{{ old('judul') }}" required>
            </div>
        </div>

        <div class="form-group">
            <label for="kkm" class="col-form-label">KKM</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fas fa-trophy"></i></div>
                </div>
                <input type="number" class="form-control" id="kkm" name="kkm" placeholder="Masukkan nilai kkm" value="{{ old('kkm') }}" required>
            </div>
        </div>

        <div class="form-group">
            <label for="waktu_pengerjaan" class="col-form-label">Waktu Pengerjaan</label>
            <input type="text" class="form-control timing" id="waktu_pengerjaan" name="waktu_pengerjaan" value="{{ old('waktu_pengerjaan') }}" required>
        </div>
        
        <div class="form-group">
            <label for="catatan" class="col-form-label">Catatan</label>
            <textarea name="catatan" id="catatan" class="form-control">{{ old('catatan') }}</textarea>
        </div>

        <div class="form-group">
            <label for="lihat_nilai" class="col-form-label">Siswa Lihat Nilai</label>
            <select name="lihat_nilai" id="lihat_nilai" class="form-control">
                <option value="Y" {{ old('lihat_nilai') == 'Y' ? 'selected' : '' }}>Iya</option>
                <option value="N" {{ old('lihat_nilai') == 'N' ? 'selected' : '' }}>Tidak</option>
            </select>
        </div>

        <div class="btn-group btn-block">
            <a href="{{ url('ujian') }}" class="btn btn-danger btn-membesar" data-toggle="tooltip" data-placement="bottom" title="Kembali"><i class="fas fa-arrow-left"></i></a>
            <button type="submit" class="btn btn-primary btn-membesar" data-toggle="tooltip" data-placement="bottom" title="Tambah Data Ujian"><i class="fas fa-plus"></i></button>
        </div>
    </form>
</div>
@endsection

@section('js')
@include('layouts/navbar/navbar_admin_footer')

<script>
    $(window).on('load', function(){
        $('#sidebar-menu-ujian').addClass('active');
    });

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