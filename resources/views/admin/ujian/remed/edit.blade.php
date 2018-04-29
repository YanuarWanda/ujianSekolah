@extends('layouts.app')

@section('css')
<style>
    .caraTambah{
        display:none;
    }
</style>
@endsection

@section('content')
@include('layouts/navbar/navbar_admin')
<div class="container text-dark mt-2 mb-2">
    <ul class="nav nav-tabs" id="tabEdit" role="tabList">
        <li class="nav-item">
            <a href="#edit" class="nav-link active" id="edit-tab" data-toggle="tab" role="tab" aria-controls="edit" aria-selected="true">Ujian</a>
        </li>
        <li class="nav-item">
            <a href="#soal" class="nav-link" id="soal-tab" data-toggle="tab" role="tab" aria-controls="soal" aria-selected="false">Daftar Soal</a>
        </li>
    </ul>

    <div class="tab-content" id="tabBuatEdit">
        <div class="tab-pane fade show active" id="edit" role="tabpanel" aria-labelledby="edit-tab">
            <div class="card">
                <form action="{{ url('ujian/remed/detail', base64_encode($ujianRemedial->id_ujian_remedial)) }}" method="POST">
                    {{ csrf_field() }}
                    <div class="card-body">
                        <h1 class="text-center">Form Ubah Remed</h1>
                        <hr>
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="judul">Judul Ujian</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="fas fa-id-badge fa-fw"></i></div>
                                        </div>
                                        <input type="text" name="judul" id="judul" class="form-control" value="{{ $ujianRemedial->ujian->judul_ujian }}" readonly="">
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
                                        <input type="text" name="mapel" id="mapel" class="form-control" value="{{ $ujianRemedial->ujian->mapel->nama_mapel }}" readonly="">
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
                                        <input type="text" name="kkm" id="kkm" class="form-control" value="{{ $ujianRemedial->ujian->kkm }}" readonly="">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="waktu_pengerjaan" class="col-form-label">Waktu Pengerjaan</label>
                                    <input type="text" class="form-control timing" id="waktu_pengerjaan" name="waktu_pengerjaan" value="{{ $wp }}" required="">
                                </div>
                            </div>
                            <div class="col-lg-9">
                                <div class="form-group">
                                    <label for="catatan">Catatan</label>
                                    <textarea name="catatan" id="catatan" class="form-control" rows="4" required="">{{ $ujianRemedial->catatan }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="btn-group btn-block">
                            <a href="{{ url('ujian') }}" class="btn btn-danger btn-membesar" data-toggle="tooltip" data-placement="top" title="Kembali"><i class="fas fa-arrow-left"></i></a>
                            <button type="submit" class="btn btn-primary btn-membesar" data-toggle="tooltip" data-placement="top" title="Ubah Data Ujian Remed"><i class="fas fa-edit"></i></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="tab-pane fade" id="soal" role="tabpanel" aria-labelledby="soal-tab">
            <div class="card">
                <div class="card-body">
                <h1 class="text-center">Daftar Soal</h1>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover datatables" id="tabelSoal">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Tipe</th>
                                    <th>Soal</th>
                                    <th>Pilihan</th>
                                    <th>Jawaban</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no=1; ?>
                                @foreach($soal as $s)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $s->bankSoal->tipe }}</td>
                                        <td>{!! $s->bankSoal->isi_soal !!}</td>
                                        <td>{!! $s->bankSoal->pilihan !!}</td>
                                        <td>{!! $s->bankSoal->jawaban !!}</td>
                                        <td>
                                            <div class="btn-group btn-block">
                                                <a href="{{ url('ujian/remed/editSoalRemed', base64_encode($s->id_soal_remedial)) }}" class="btn btn-info" data-toggle="tooltip" data-placement="bottom" title="Edit Soal"><i class="fas fa-edit"></i></a>
                                                <button type="button" href="{{ url('ujian/remed/deleteSoalRemed', base64_encode($s->id_soal_remedial)) }}" class="btn btn-danger deleteButton" data-toggle="tooltip" data-placement="bottom" title="Hapus Soal dari Ujian"><i class="fas fa-trash"></i></button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>    
                </div>
            </div>
            <hr>
            <button type="button" class="btn btn-primary btn-block" id="showTambahSoal"><i class="fas fa-plus">&nbsp;Tambah Soal ke Ujian Remed</i></button>
            <div class="btn-group btn-block caraTambah">
                <a href="{{ url('ujian/remed/tambahDariBankSoal', base64_encode($ujianRemedial->id_ujian_remedial)) }}" class="btn btn-info btn-block">Import dari Bank Soal</a>
                <a href="{{ url('ujian/remed/tambahSoalRemed', base64_encode($ujianRemedial->id_ujian_remedial)) }}" class="btn btn-primary btn-block">Tambah Soal Sendiri</a>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>
@endsection

@section('js')
@include('layouts/navbar/navbar_admin_footer')
<script>
$(window).on('load', function(){
    $('#sidebar-menu-ujian').addClass('active');
});

$(document).ready(function(){
    $('#tabelSoal tbody').on('click', '.deleteButton', function(){
        var $url = $(this).attr('href');
        swal({
            title: 'Hapus data ?',
            text: 'Jika data soal dihapus maka data yang bersangkutan akan ikut terhapus juga.',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Okelah, hapus aja!',
        }).then(function(result){
            window.location.replace($url);
        });
    });

    $('#showTambahSoal').on('click', function(){
        $('.caraTambah').slideToggle(500);
    });

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