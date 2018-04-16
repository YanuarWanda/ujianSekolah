@extends('layouts.app')

@section('css')
<style type="text/css">
    .purple .profile{
        background-color: #9b59b6;
        color: white;
    }
</style>
@stop

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-4">
            <div class="panel panel-default purple">
                <div class="panel-heading">
                    <center><span class="panel-title">{{ strtoupper($siswa->nama) }}</span></center>
                </div>

                <div class="panel-body">
                    <p align="center">
                        <?php if($siswa->foto != 'nophoto.jpg'){?>
                            <a target="_blank" href="{{asset('storage/foto-profil/'.$siswa->foto)}}"><img src="{{asset('storage/foto-profil/'.$siswa->foto)}}" height="150px" /></a>
                        <?php }else{ ?>
                            <img src="{{asset('image/nophoto.jpg')}}" height="150px"/>
                        <?php } ?>
                    </p>
                </div>

                <div class="panel-body profile">
                    <div class="table-responsive">
                    <table class="table">
                        <tr>
                            <td>NIS</td>
                            <td>{{ $siswa->nis }}</td>
                        </tr>
                        <tr>
                            <td>Alamat</td>
                            <td>{{ $siswa->alamat }}</td>
                        </tr>
                        <tr>
                            <td>Jenis Kelamin</td>
                            <td>@if($siswa->jenis_kelamin == 'L') Laki-laki @else Perempuan @endif</td>
                        </tr>
                        <tr>
                            <td>Kelas</td>
                            <td>{{ $siswa->kelas->nama_kelas }}</td>
                        </tr>
                    </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8">

            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active"><a href="#ujian" aria-controls="ujian" role="tab" data-toggle="tab">Ujian</a></li>
                <li role="presentation"><a href="#remed" aria-controls="remed" role="tab" data-toggle="tab">Remedial</a></li>
            </ul>

            <div class="tab-content">
                <div role="tabpanel" class="tab-pane fade in active" id="ujian">
                    <br>

                    @if($ujian->count() > 0)
                    <div class="row">
                        <form method="post" action="{{ route('siswa.search') }}">
                            {{ csrf_field() }}

                        <div class="col-md-4">
                            @if(isset($_POST['search_query']))
                            <span>Ujian dengan judul 
                                <code>{{$_POST['search_query']}}</code>
                            </span>
                            @endif
                        </div>
                        <div class="col-md-6 form-group">
                            <input type="text" name="search_query" placeholder="Judul Ujian ..." class="form-control">
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary"><span class="fa fa-search"></span></button>
                        </div>

                        </form>
                    </div>

                    <?php $index=0; ?>
                    @foreach($ujian as $u => $isi)
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4>{{ $isi->judul_ujian }}</h4><span class="label label-primary">{{ $isi->nama_mapel }}</span>
                        </div>

                        <div class="panel-body">
                            <h5>Dipost pada <span style="color: red;">{{ date('d M, Y', strtotime($isi->tanggal_post)) }}</span></h5>
                            <hr>
                            <h5>Batas Pengerjaan <span style="color: red">{{ date('d M, Y', strtotime($isi->tanggal_kadaluarsa)) }}</span></h5>
                            <hr>
                            <strong>Deskripsi</strong>
                            <h5>{{ $isi->catatan }}</h5>
                        </div>
                        @if(count($nilai) < 1)
                            <div class="panel-footer">
                                <a href="{{ url('/soal', base64_encode($isi->id_ujian)) }}" class="btn btn-primary">Kerjakan</a>
                            </div>
                        @else
                            @foreach($nilai as $n => $isiNilai)
                                @if($isi->id_ujian == $isiNilai->id_ujian)
                                <div class="panel-footer">
                                    <p>Anda Sudah Mengerjakan!</p> @if($isi->lihat_nilai == 'Y') <p>Jawaban Benar {{ $isiNilai->jawaban_benar }}/{{ $isiNilai->jawaban_benar + $isiNilai->jawaban_salah }}</p> <p>Nilai {{ $isiNilai->nilai }}</p>@endif
                                </div>
                                <?php break; ?>
                                @elseif($isi->id_ujian != $isiNilai->id_ujian)
                                    @if($n != count($nilai)-1)
                                    <?php continue; ?>
                                    @elseif($n == count($nilai)-1)
                                    <div class="panel-footer">
                                        <a href="{{ url('/soal', base64_encode($isi->id_ujian)) }}" class="btn btn-primary">Kerjakan</a>
                                    </div>
                                    @endif
                                @endif
                            @endforeach
                        @endif
                    </div>
                    @endforeach

                    @else

                    <h3>Tidak ada ujian.</h3>

                    @endif

                    <div class="pull-right">
                        {{ $ujian->links() }}
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="remed">
                    
                    <br>

                    @if($ujianRemed->count() > 0)

                    <div class="row">
                        <form method="post" action="{{ route('siswa.search') }}">
                            {{ csrf_field() }}
                        <div class="col-md-8 form-group">
                            <input type="text" name="search_query" placeholder="Judul Ujian ..." class="form-control">
                        </div>
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-primary"><span class="fa fa-search"></span></button>
                        </div>
                        </form>
                    </div>

                    <?php $indexRemed=0; ?>
                    @foreach($ujianRemed as $uR => $isiR)
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4>{{ $isiR->judul_ujian }} - Remedial {{ $isiR->remed_ke }} <span class="label label-danger">{{ $isiR->nama_mapel }}</span class="label label-danger"></h4>
                        </div>

                        <div class="panel-body">
                            <p>Dipost pada <span style="color: red;">{{ $isiR->tanggal_pembuatan }}</span></p>
                            <hr>
                            <p>Batas Pengerjaan <span style="color: red">{{ $isiR->tanggal_kadaluarsa }}</span></p>
                            <hr>
                            <strong>Deskripsi</strong>
                            <p>{{ $isiR->catatan }}</p>
                        </div>

                        @if(count($nilaiR) == count($ujianRemedArray))
                            <div class="panel-footer">
                                    <p>Anda Sudah Mengerjakan!</p>
                            </div>
                        @elseif(count($nilaiR) == 0)
                            <div class="panel-footer">
                                <a href="{{ url('/remed', base64_encode($isiR->id_ujian_remedial)) }}" class="btn btn-primary">Kerjakan</a>
                            </div>
                        @else
                            @foreach($nilaiR as $nR => $isiNilaiR)
                                @if($isiR->id_ujian_remedial == $isiNilaiR->id_ujian_remedial)
                                <div class="panel-footer">
                                    <p>Anda Sudah Mengerjakan!</p>
                                </div>
                                <?php break; ?>
                                @elseif($isiR->id_ujian_remedial != $isiNilaiR->id_ujian_remedial)
                                    @if($nR != count($nilaiR)-1)
                                        <?php continue; ?>
                                    @elseif($nR == count($nilaiR)-1)
                                        <div class="panel-footer">
                                            <a href="{{ url('/remed', base64_encode($isiR->id_ujian_remedial)) }}" class="btn btn-primary">Kerjakan</a>
                                        </div>
                                    @endif
                                @endif
                            @endforeach
                        @endif
                    </div>
                    @endforeach

                    @else

                    <h3>Remedial tidak ada.</h3>

                    @endif
                    <div class="pull-right">
                        {{ $ujianRemed->links() }}
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
@section('js')

@endsection