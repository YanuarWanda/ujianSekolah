@extends('layouts/app')

@section('css')
<style>
    .caraTambah{
        display:none;
    }
</style>
@endsection

@section('content')
@include('layouts/navbar/navbar_guru')
<div class="container text-dark p-5">

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
                <div class="card-body">
                    <h1 class="text-center">Form Edit Ujian</h1>
                    <form action="{{ url('guru/ujian/edit', base64_encode($ujian->id_ujian)) }}" method="POST" id="formTambahUjian">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="mapel" class="col-form-label">Mata Pelajaran</label>
                            <select name="mapel" id="mapel" class="form-control">
                                @foreach($mapel as $m)
                                    <option value="{{ $m->id_mapel }}" @if($ujian->id_mapel == $m->id_mapel) selected @endif>{{ $m->nama_mapel }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="judul" class="col-form-label">Judul Ujian</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fas fa-id-badge"></i></div>
                                </div>
                                <input type="text" class="form-control" id="judul" name="judul" placeholder="Masukkan judul ujian" value="{{ $ujian->judul_ujian }}" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="kkm" class="col-form-label">KKM</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fas fa-trophy"></i></div>
                                </div>
                                <input type="number" class="form-control" id="kkm" name="kkm" placeholder="Masukkan nilai kkm" value="{{ $ujian->kkm }}" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="waktu_pengerjaan" class="col-form-label">Waktu Pengerjaan</label>
                            <input type="text" class="form-control timing" id="waktu_pengerjaan" name="waktu_pengerjaan" value="{{ $wp }}" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="catatan" class="col-form-label">Catatan</label>
                            <textarea name="catatan" id="catatan" class="form-control">{{ $ujian->catatan }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="lihat_nilai" class="col-form-label">Siswa Lihat Nilai</label>
                            <select name="lihat_nilai" id="lihat_nilai" class="form-control">
                                <option value="Y" {{ $ujian->lihat_nilai == 'Y' ? 'selected' : '' }}>Iya</option>
                                <option value="N" {{ $ujian->lihat_nilai == 'N' ? 'selected' : '' }}>Tidak</option>
                            </select>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="btn-group btn-block">
                            <a href="{{ url('guru/ujian') }}" class="btn btn-danger btn-membesar" data-toggle="tooltip" data-placement="bottom" title="Kembali"><i class="fas fa-arrow-left"></i></a>
                            <button type="submit" class="btn btn-primary btn-membesar" data-toggle="tooltip" data-placement="bottom" title="Ubah Data Ujian"><i class="fas fa-edit"></i></button>
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
                                                <a href="{{ url('guru/ujian/editSoalUjian', base64_encode($s->id_soal)) }}" class="btn btn-info btn-membesar half" data-toggle="tooltip" data-placement="bottom" title="Edit Soal"><i class="fas fa-edit"></i></a>
                                                <button type="button" href="{{ url('guru/ujian/deleteSoalUjian', base64_encode($s->id_soal)) }}" class="btn btn-danger btn-membesar half deleteButton" data-toggle="tooltip" data-placement="bottom" title="Hapus Soal dari Ujian"><i class="fas fa-trash"></i></button>
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
            <button type="button" class="btn btn-primary btn-block" id="showTambahSoal"><i class="fas fa-plus">&nbsp;Tambah Soal ke Ujian</i></button>
            <div class="btn-group btn-block caraTambah">
                <a href="{{ url('guru/ujian/tambahDariBankSoal', base64_encode($ujian->id_ujian)) }}" class="btn btn-info btn-block">Import dari Bank Soal</a>
                <a href="{{ url('guru/ujian/tambahSoalUjian', base64_encode($ujian->id_ujian)) }}" class="btn btn-primary btn-block">Tambah Soal Sendiri</a>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
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