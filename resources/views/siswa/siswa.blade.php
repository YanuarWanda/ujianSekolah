@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4">
            <div class="panel panel-success">
                <div class="panel-heading">
                    <center>{{ strtoupper($siswa->nama) }}</center>
                </div>

                <div class="panel-body">
                    <p align="center">
                        <?php if($siswa->foto != 'nophoto.jpg'){?>
                            <img src="{{asset('storage/foto-profil/'.$siswa->foto)}}" width="250px"/></td>
                        <?php }else{ ?>
                            <img src="{{asset('image/nophoto.jpg')}}" width="250px"/></td>
                        <?php } ?>
                    </p>
                    <p>NIS : {{ $siswa->nis }}</p>
                    <p>Alamat : {{ $siswa->alamat }}</p>
                    <p>Jenis Kelamin : @if($siswa->jenis_kelamin == 'L') Laki-laki @else Perempuan @endif</p>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <h1 style="margin-top: -5px; margin-bottom: 25px; text-align: center;">Daftar Ujian</h1>
            @foreach($ujian as $u)
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4>{{ $u->judul_ujian }} <code>{{ $u->nama_mapel }}</code></h4>
                </div>

                <div class="panel-body">
                    <p>Dibuat pada <span style="color: red;">{{ $u->tanggal_post }}</span></p>
                    <strong>Deskripsi</strong>
                    <p>{{ $u->catatan }}</p>
                </div>

                <div class="panel-footer">
                    <a href="{{ url('/soal/{id}', base64_encode($u->id_ujian)) }}" class="btn btn-primary">Kerjakan</a>
                </div>
            </div>
            @endforeach
            <div class="pull-right">
                {{ $ujian->links() }}
            </div>
        </div>
    </div>
</div>
@endsection