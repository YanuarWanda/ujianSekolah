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
            <?php $index=0; ?>
            @foreach($ujian as $u => $isi)
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4>{{ $isi->judul_ujian }} <code>{{ $isi->nama_mapel }}</code></h4>
                </div>

                <div class="panel-body">
                    <p>Dibuat pada <span style="color: red;">{{ $isi->tanggal_post }}</span></p>
                    <p>Batas Pengerjaan <span style="color: red">{{ $isi->tanggal_kadaluarsa }}</span></p>
                    <strong>Deskripsi</strong>
                    <p>{{ $isi->catatan }}</p>
                </div>
                {{-- @foreach($nilai as $n) --}}
                    {{-- {{ $u->id_ujian.', '.$n['id_ujian'] }} --}}
                @if(count($nilai) == count($ujianArray))
                        @if($isi->id_ujian == $nilai[$index]['id_ujian'])
                            <div class="panel-footer">
                                <p>Anda Sudah Mengerjakan!</p>
                            </div>
                        @elseif($isi->id_ujian != $nilai[$index]['id_ujian'])
                            <div class="panel-footer">
                                <a href="{{ url('/soal', base64_encode($isi->id_ujian)) }}" class="btn btn-primary">Kerjakan</a>
                            </div>
                        @endif

                @elseif(count($nilai) == 0)
                    <div class="panel-footer">
                        <a href="{{ url('/soal', base64_encode($isi->id_ujian)) }}" class="btn btn-primary">Kerjakan</a>
                    </div>
                @else
                    {{-- @foreach($nilai as $n) --}}
                        {{-- {{ $isi->id_ujian.', '.$nilai[$index]['id_ujian'].', '.$index }} --}}
                        {{-- {{ $isi->id_ujian.', '.$nilai[$index]['id_ujian']}} --}}
                        @if($isi->id_ujian == $nilai[$index]['id_ujian'])
                            <div class="panel-footer">
                                <p>Anda Sudah Mengerjakan!</p>
                            </div>
                        @elseif($isi->id_ujian != $nilai[$index]['id_ujian'])
                            <div class="panel-footer">
                                <a href="{{ url('/soal', base64_encode($isi->id_ujian)) }}" class="btn btn-primary">Kerjakan</a>
                            </div>
                        @endif
                    {{-- @endforeach --}}
                    <?php if($index < count($nilai)-1){ $index++; }?>
                @endif
                {{-- @endforeach --}}
            </div>
            {{-- {{ $index }} --}}
            @endforeach
            <div class="pull-right">
                {{ $ujian->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
