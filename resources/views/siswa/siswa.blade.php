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
                            <img src="{{asset('storage/foto-profil/'.$siswa->foto)}}" width="250px"/>
                        <?php }else{ ?>
                            <img src="{{asset('image/nophoto.jpg')}}" width="250px"/>
                        <?php } ?>
                    </p>
                    <p>NIS : {{ $siswa->nis }}</p>
                    <p>Alamat : {{ $siswa->alamat }}</p>
                    <p>Jenis Kelamin : @if($siswa->jenis_kelamin == 'L') Laki-laki @else Perempuan @endif</p>
                </div>
            </div>
            <div class="panel panel-success">
                <div class="panel-heading">
                    <h5 class="text-center">Ability</h5>
                </div>

                <div class="panel-body">
                    <canvas id="grafikAbility" width="600px"></canvas>
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
                    <h1 style="margin-top: 25px; text-align: center;">Daftar Ujian</h1>
                    <?php $index=0; ?>
                    @foreach($ujian as $u => $isi)
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4>{{ $isi->judul_ujian }} <code>{{ $isi->nama_mapel }}</code></h4>
                        </div>

                        <div class="panel-body">
                            <p>Dipost pada <span style="color: red;">{{ $isi->tanggal_post }}</span></p>
                            <p>Batas Pengerjaan <span style="color: red">{{ $isi->tanggal_kadaluarsa }}</span></p>
                            <strong>Deskripsi</strong>
                            <p>{{ $isi->catatan }}</p>
                        </div>
                        @if(count($nilai) < 1)
                            <div class="panel-footer">
                                <a href="{{ url('/soal', base64_encode($isi->id_ujian)) }}" class="btn btn-primary">Kerjakan</a>
                            </div>
                        @else
                            @foreach($nilai as $n => $isiNilai)
                                @if($isi->id_ujian == $isiNilai->id_ujian)
                                <div class="panel-footer">
                                    <p>Anda Sudah Mengerjakan!</p> @if($isi->lihat_nilai == 'Y') <p>Jawbaan Benar {{ $isiNilai->jawaban_benar }}/{{ $isiNilai->jawaban_benar + $isiNilai->jawaban_salah }}</p> <p>Nilai {{ round($isiNilai->jawaban_benar / ($isiNilai->jawaban_benar + $isiNilai->jawaban_salah) * 100) }}</p>@endif
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
                    <div class="pull-right">
                        {{ $ujian->links() }}
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="remed">
                    <h1 style="margin-top: 25px; text-align: center;">Daftar Ujian Remedial</h1>
                    <?php $indexRemed=0; ?>
                    @foreach($ujianRemed as $uR => $isiR)
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4>{{ $isiR->judul_ujian }} - Remed {{ $isiR->remed_ke }}<code>{{ $isiR->nama_mapel }}</code></h4>
                        </div>

                        <div class="panel-body">
                            <p>Dipost pada <span style="color: red;">{{ $isiR->tanggal_pembuatan }}</span></p>
                            <p>Batas Pengerjaan <span style="color: red">{{ $isiR->tanggal_kadaluarsa }}</span></p>
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
<script>
    var $skill = {!! $ability !!};
    var $mapel = [];var $nilai =[];
    $skill.forEach(function(realData){
        $mapel.push(realData.mapel);
        $nilai.push(realData.nilai);
    });

    console.log($mapel);
    console.log($nilai);

    var dataBuatChart = {
        labels: $mapel,
        datasets: [{
            label: 'Nilai',
            backgroundColor: 'rgba(128, 128, 128, 0.5)',
            data: $nilai
        }]  
    };
    var dataCanvasnya = document.getElementById('grafikAbility').getContext('2d');

    var chartnya = new Chart(dataCanvasnya, {
        type: 'radar',
        data: dataBuatChart
    });
</script>
@endsection