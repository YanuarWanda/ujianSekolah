@extends('layouts/app')

@section('content')
@include('layouts/navbar/navbar_siswa')
<div class="container text-dark p-5">
    <ul class="nav nav-tabs" id="navUjian" role="tablist">
        <li class="nav-item">
            <a href="#ujian" class="nav-link active" id="ujian-tab" data-toggle="tab" role="tab" aria-controls="ujian" aria-selected="true">Daftar Ujian</a>
        </li>
        <li class="nav-item">
            <a href="#remed" class="nav-link" id="remed-tab" data-toggle="tab" role="tab" aria-controls="remed" aria-selected="false">Daftar Remed</a>
        </li>
    </ul>

    <div class="tab-content" id="tabUjian">
        <div class="tab-pane fade show active mt-2" id="ujian" role="tabpanel" aria-labelledby="ujian-tab">
            <h1 class="text-center">Daftar Ujian</h1>
            <div class="row">
                @foreach($ujian as $u => $uValue)
                    <div class="col-lg-6">    
                        <div class="card mb-2">
                            <div class="card-header">
                                <h5 class="text-center">{{ $uValue->judul_ujian }}</h5>
                                <h6 class="text-center"><span class="badge badge-success">{{ $uValue->nama_mapel }}</span></h6>
                            </div>
                            <div class="card-body">
                                <p>Dipost pada <span class="text-danger">{{ $uValue->tanggal_post }}</span> oleh <span class="text-success">{{ $uValue->nama }}</span></p>
                                <p>Batas Pengerjaan <span class="text-danger">{{ $uValue->tanggal_kadaluarsa }}</span></p>
                                <p>Waktu Pengerjaan <span class="text-danger">{{ $uValue->waktu_pengerjaan }}</span></p>
                                <strong>Catatan</strong>
                                <p>{{ $uValue->catatan }}</p>
                            </div>
                            @if(count($nilai) < 1)
                                <div class="card-footer">
                                    <a href="{{ url('siswa/kerjakan', base64_encode($uValue->id_ujian)) }}" class="btn btn-primary">Kerjakan!</a>
                                </div>
                            @else
                                @foreach($nilai as $n => $nValue)
                                    @if($uValue->id_ujian == $nValue->id_ujian)
                                        <div class="card-footer">
                                            <p>Anda Sudah Mengerjakan!</p>
                                            @if($uValue->lihat_nilai == 'Y') <p>Jawaban Benar : {{ $nValue->jawaban_benar }}/{{ $nValue->jawaban_benar + $nValue->jawaban_salah }} | Nilai : {{ $nValue->nilai  }}</p> @endif
                                        </div>
                                        <?php break; ?>
                                    @elseif($uValue->id_ujian != $nValue->id_ujian)
                                        @if($n == count($nilai)-1)
                                            <div class="card-footer">
                                                <a href="{{ url('siswa/kerjakan', base64_encode($uValue->id_ujian)) }}" class="btn btn-primary">Kerjakan!</a>
                                            </div>
                                        @endif
                                    @endif
                                @endforeach
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="float-right">
                {{ $ujian->links() }}
            </div>
        </div>
        <div class="tab-pane fade" id="remed" role="tabpanel" aria-labelledby="remed-tab">
            <h1 class="text-center">Daftar Remed</h1>
            <div class="row">   
                @foreach($ujianRemed as $uR => $isiR)
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header text-center">
                                <h4>{{ $isiR->judul_ujian }} - Remed {{ $isiR->remed_ke }} <br> <span class="badge badge-success">{{ $isiR->nama_mapel }}</span></h4>
                            </div>

                            <div class="card-body">
                                <p>Batas Pengerjaan <span style="color: red">{{ $isiR->tanggal_kadaluarsa }}</span></p>
                                <strong>Catatan</strong>
                                <p>{{ $isiR->catatan }}</p>
                            </div>

                            @if(count($nilaiR) == count($ujianRemedArray))
                                <div class="card-footer">
                                        <p>Anda Sudah Mengerjakan!</p>
                                </div>
                            @elseif(count($nilaiR) == 0)
                                <div class="card-footer">
                                    <a href="{{ url('siswa/kerjakan-remed', base64_encode($isiR->id_ujian_remedial)) }}" class="btn btn-primary">Kerjakan</a>
                                </div>
                            @else
                                @foreach($nilaiR as $nR => $isiNilaiR)
                                    @if($isiR->id_ujian_remedial == $isiNilaiR->id_ujian_remedial)
                                    <div class="card-footer">
                                        <p>Anda Sudah Mengerjakan!</p>
                                    </div>
                                    <?php break; ?>
                                    @elseif($isiR->id_ujian_remedial != $isiNilaiR->id_ujian_remedial)
                                        @if($nR != count($nilaiR)-1)
                                            <?php continue; ?>
                                        @elseif($nR == count($nilaiR)-1)
                                            <div class="card-footer">
                                                <a href="{{ url('siswa/kerjakan-remed', base64_encode($isiR->id_ujian_remedial)) }}" class="btn btn-primary">Kerjakan</a>
                                            </div>
                                        @endif
                                    @endif
                                @endforeach
                            @endif
                        </div>
                    </div>
                @endforeach
                <div class="float-right">
                    {{ $ujianRemed->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection