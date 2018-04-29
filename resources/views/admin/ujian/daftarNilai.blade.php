@extends('layouts.app')

@section('css')
<style>
.block-parent.active{
    background-color: lightgrey;
    border: none;
}
.btn-fixed-bottom-right{
    position:fixed;
    bottom: 10px;
    right: 10px;
}
.card{
    margin-bottom: 2rem;
}
.z-top{
    z-index: 9999;
}
.title{
    font-size: 20px;
}
</style>
@endsection

@section('content')
@include('layouts/navbar/navbar_admin')
    <div class="container text-dark mt-2">
        <a href="{{url('guru/ujian/nilai/export', base64_encode($ujian->id_ujian))}}" class="btn btn-primary btn-fixed-bottom-right z-top">Export Nilai</a>
        <div class="row">
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header text-center title"><strong>Grafik Rata-Rata Nilai per Kelas</strong></div>
                    <div class="card-body">
                        <canvas id="chartPerKelas" height="350px"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header text-center title"><strong>Nilai Tertinggi</strong></div>
                    <div class="card-body">
                        <table class="table table-bordered table-hover datatables">
                            <thead class="bg-dark text-light">
                                <tr>
                                    <th>No.</th>
                                    <th>Nama</th>
                                    <th>Kelas</th>
                                    <th>Nilai</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($nilaiTertinggi as $number => $nt)
                                    <tr>
                                        <td>{{ ++$number }}</td>
                                        <td>{{ $nt->nama }}</td>
                                        <td>{{ $nt->nama_kelas }}</td>
                                        <td>{{ $nt->nilai }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <hr><div class="card">
            <div class="card-header text-center title"><strong>Data Nilai</strong></div>
            <div class="card-body">
                <div>
                    @if(count($nilai) > 0)
                        <?php $no=1;?>
                            @foreach($jumlahNilai as $n => $isiJumlah)
                                <div class="block mb-2" data-panel="Kelas_{{$n}}">
                                    <button type="button" class="btn btn-primary btn-block">{{ $isiJumlah['nama_kelas'] }}</button>
                                </div>

                                <div class="blockKelas" id="Kelas_{{$n}}" style="display:none">
                                    <table class="table table-bordered" id="tableNilai">
                                        <?php $index=0; ?>
                                            <thead>
                                                <tr>
                                                    <th>No.</th>
                                                    <th>Nama</th>
                                                    <th>Nilai Ujian</th>
                                                    <th>Nilai Remed 1</th>
                                                    <th>Nilai Remed 2</th>
                                                    <th>Nilai Remed 3</th>
                                                </tr>
                                            </thead>
                                            
                                            @foreach($nilai as $ni => $isiN)
                                                @if($isiN['id_kelas'] == $isiJumlah['id_kelas'])
                                                    <tbody aria-expanded="false">
                                                        <tr class="block-fade" data-panel="Siswa_{{$ni}}">
                                                            <td><?php echo $no;$no++; ?></td>
                                                            <td>{{$isiN->nama}}</td>
                                                            @if($isiN['nilai'] < $isiN->ujian->kkm)
                                                                <td class="text-danger">
                                                                    {{$isiN['nilai']}}
                                                                </td>
                                                            @else
                                                                <td class="text-success">
                                                                    {{ $isiN['nilai'] }}
                                                                </td>
                                                            @endif

                                                            @foreach($nilaiRemed as $nr => $isiNR)    
                                                                @if($isiNR['id_siswa'] == $isiN['id_siswa'] && $isiNR['remed_ke'] == '1')
                                                                    @if($isiNR['nilai_remedial'] < $isiN->ujian->kkm)
                                                                        <td class="text-danger">
                                                                            {{ $isiNR['nilai_remedial'] }}
                                                                        </td>
                                                                        <?php break; ?>
                                                                    @elseif($isiNR['nilai_remedial'] >= $isiN->ujian->kkm)
                                                                        <td class="text-success">
                                                                            {{ $isiNR['nilai_remedial'] }}
                                                                        </td>
                                                                        <?php break; ?>
                                                                    @endif
                                                                @endif
                                                            @endforeach
                                                            @foreach($nilaiRemed as $nr => $isiNR)    
                                                                @if($isiNR['id_siswa'] == $isiN['id_siswa'] && $isiNR['remed_ke'] == '2')
                                                                    @if($isiNR['nilai_remedial'] < $isiN->ujian->kkm)
                                                                        <td class="text-danger">
                                                                            {{ $isiNR['nilai_remedial'] }}
                                                                        </td>
                                                                    @elseif($isiNR['nilai_remedial'] >= $isiN->ujian->kkm)
                                                                        <td clas="text-success">
                                                                            {{ $isiNR['nilai_remedial'] }}
                                                                        </td>
                                                                    @endif
                                                                @endif
                                                            @endforeach
                                                            @foreach($nilaiRemed as $nr => $isiNR)    
                                                                @if($isiNR['id_siswa'] == $isiN['id_siswa'] && $isiNR['remed_ke'] == '3')
                                                                    @if($isiNR['nilai_remedial'] < $isiN->ujian->kkm)
                                                                        <td class="text-danger">
                                                                            {{ $isiNR['nilai_remedial'] }}
                                                                        </td>
                                                                    @elseif($isiNR['nilai_remedial'] >= $isiN->ujian->kkm)
                                                                        <td clas="text-success">
                                                                            {{ $isiNR['nilai_remedial'] }}
                                                                        </td>
                                                                    @endif
                                                                @endif
                                                            @endforeach
                                                        </tr>

                                                        <tr id="Siswa_{{$ni}}" class="collapse">
                                                            <td colspan=8>
                                                                <ul class="nav nav-tabs" role="tablist">
                                                                    <li class="nav-item">
                                                                        <a class="nav-link active" href="#ujian_{{$ni}}" aria-controls="ujian_{{$ni}}" role="tab" data-toggle="tab" aria-selected="true">Ujian</a>
                                                                    </li>
                                                                    <li class="nav-item">
                                                                        <a class="nav-link" href="#remed_{{$ni}}" aria-controls="remed_{{$ni}}" role="tab" data-toggle="tab" aria-selected="false">Remedial 1</a>
                                                                    </li>
                                                                    <li class="nav-item">
                                                                        <a class="nav-link" href="#remed2_{{$ni}}" aria-controls="remed2_{{$ni}}" role="tab" data-toggle="tab" aria-selected="false">Remedial 2</a>
                                                                    </li>
                                                                    <li class="nav-item">
                                                                        <a class="nav-link" href="#remed3_{{$ni}}" aria-controls="remed3_{{$ni}}" role="tab" data-toggle="tab" aria-selected="false">Remedial 3</a>
                                                                    </li>
                                                                </ul>

                                                                <div class="tab-content">
                                                                    <div role="tabpanel" class="tab-pane fade show active" id="ujian_{{$ni}}">
                                                                        <table class="table table-bordered">
                                                                            <tr>
                                                                                <th> No </th>
                                                                                <th> Soal </th>
                                                                                <th> Jawaban Siswa </th>
                                                                                <th> Jawaban Benar </th>
                                                                                <th> Point </th>
                                                                                <th> Hasil </th>
                                                                            </tr>
                                                                        <?php $ns=1; ?>

                                                                        @foreach($soal as $s => $isiS)
                                                                            <tr>
                                                                                <td> <?php echo $ns;$ns++; ?> </td>
                                                                                <td>
                                                                                    {!! $isiS->bankSoal->isi_soal !!}
                                                                                </td>
                                                                                <td> 
                                                                                    @foreach($jawabanUjian as $ju => $isiJU)
                                                                                        @if($isiJU->id_siswa == $isiN->id_siswa)
                                                                                            @if($isiJU->id_soal == $isiS->id_soal)
                                                                                                {!! $isiJU->jawaban_siswa !!}
                                                                                            @endif
                                                                                        @endif
                                                                                    @endforeach    
                                                                                </td>
                                                                                <td> {!! $jawaban_benar[$s] !!} </td>
                                                                                <td> {{ $isiS['point'] }}</td>
                                                                                <td> 
                                                                                    @foreach($jawabanUjian as $ju => $isiJU)
                                                                                        @if($isiJU->id_siswa == $isiN->id_siswa)
                                                                                            @if($isiJU->id_soal == $isiS->id_soal)
                                                                                                @if($isiJU->jawaban_siswa == $jawaban_benar[$s])
                                                                                                    <span class="text-success">Benar</span>
                                                                                                @else
                                                                                                    <span class="text-danger">Salah</span>
                                                                                                @endif
                                                                                            @endif
                                                                                        @endif
                                                                                    @endforeach    
                                                                                </td>
                                                                            </tr>    
                                                                        @endforeach
                                                                        </table>

                                                                        <table class="table table-bordered">
                                                                            <tr>
                                                                                <th>Jumlah Benar</th>
                                                                                <th>Jumlah Salah</th>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>{{ $isiN['jawaban_benar'] }}</td>
                                                                                <td>{{ $isiN['jawaban_salah'] }}</td>
                                                                            </tr>
                                                                        </table>
                                                                    </div>

                                                                    @if(count($jumlahRemed) > 0)
                                                                        @foreach($jumlahRemed as $jr1 => $isiJR1)
                                                                            @if($isiN['id_siswa'] == $isiJR1['id_siswa'] && $isiJR1['remed_ke'] == 1)
                                                                            <div role="tabpanel" class="tab-pane fade" id="remed_{{$ni}}">
                                                                                <table class="table table-bordered">
                                                                                    <tr>
                                                                                        <th> No </th>
                                                                                        <th> Soal </th>
                                                                                        <th> Jawaban Siswa </th>
                                                                                        <th> Jawaban Benar </th>
                                                                                        <th> Point </th>
                                                                                        <th> Hasil </th>
                                                                                    </tr>
                                                                                        <?php $nr=1; ?>
                                                                                        @if($soalRemed)
                                                                                            @foreach($soalRemed as $sr => $isiSR)
                                                                                                @if($isiSR->id_ujian_remedial == $isiJR1->id_ujian_remedial)
                                                                                                    <tr>
                                                                                                        <td> <?php echo $nr;$nr++; ?> </td>
                                                                                                        <td>
                                                                                                            {!! $isiSR->bankSoal->isi_soal !!}
                                                                                                        </td>
                                                                                                        <td>
                                                                                                            @foreach($jawabanRemed as $jr => $isiJR)
                                                                                                                @if($isiJR->id_siswa == $isiN->id_siswa)
                                                                                                                    @if($isiJR->id_soal_remedial == $isiSR->id_soal_remedial)
                                                                                                                        {!! $isiJR->jawaban_siswa !!}
                                                                                                                    @endif
                                                                                                                @endif
                                                                                                            @endforeach
                                                                                                        </td>
                                                                                                        <td> {!! $jawaban_benar_remed[$sr] !!} </td>
                                                                                                        <td> {{ $isiSR->point }}</td>
                                                                                                        <td>
                                                                                                            @foreach($jawabanRemed as $jr => $isiJR)
                                                                                                                @if($isiJR->id_siswa == $isiN->id_siswa)
                                                                                                                    @if($isiJR->id_soal_remedial == $isiSR->id_soal_remedial)
                                                                                                                        @if($isiJR->jawaban_siswa == $jawaban_benar_remed[$sr])
                                                                                                                            <span class="text-success">Benar</span>
                                                                                                                        @else
                                                                                                                            <span class="text-danger">Salah</span>
                                                                                                                        @endif
                                                                                                                    @endif
                                                                                                                @endif
                                                                                                            @endforeach
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                @endif
                                                                                            @endforeach
                                                                                        @endif
                                                                                    </table>

                                                                                    <table class="table table-bordered">
                                                                                        <tr>
                                                                                            <th>Jumlah Benar</th>
                                                                                            <th>Jumlah Salah</th>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td>{{ $isiJR1->jawaban_benar }}</td>
                                                                                            <td>{{ $isiJR1->jawaban_salah }}</td>
                                                                                        </tr>
                                                                                    </table>
                                                                                </div>
                                                                            @elseif($jr1 == count($jumlahRemed)-1)
                                                                                <div role="tabpanel" class="tab-pane fade" id="remed_{{$ni}}">
                                                                                    <table class="table table-bordered">
                                                                                        <tr>
                                                                                            <th> No </th>
                                                                                            <th> Soal </th>
                                                                                            <th> Jawaban Siswa </th>
                                                                                            <th> Jawaban Benar </th>
                                                                                            <th> Point </th>
                                                                                            <th> Hasil </th>
                                                                                        </tr>
                                                                                    </table>
                                                                                </div>        
                                                                            @endif
                                                                        @endforeach
                                                                    @else
                                                                        <div role="tabpanel" class="tab-pane fade" id="remed_{{$ni}}">
                                                                            <table class="table table-bordered">
                                                                                <tr>
                                                                                    <th> No </th>
                                                                                    <th> Soal </th>
                                                                                    <th> Jawaban Siswa </th>
                                                                                    <th> Jawaban Benar </th>
                                                                                    <th> Point </th>
                                                                                    <th> Hasil </th>
                                                                                </tr>
                                                                            </table>
                                                                        </div>
                                                                    @endif

                                                                    @if(count($jumlahRemed) > 0)
                                                                        @foreach($jumlahRemed as $jr2 => $isiJR2)
                                                                            @if($isiN['id_siswa'] == $isiJR2['id_siswa'] && $isiJR2['remed_ke'] == 2)
                                                                                <div role="tabpanel" class="tab-pane fade" id="remed2_{{$ni}}">
                                                                                    <table class="table table-bordered">
                                                                                        <tr>
                                                                                            <th>No</th>
                                                                                            <th>Soal</th>
                                                                                            <th>Jawaban Siswa</th>
                                                                                            <th>Jawaban Benar</th>
                                                                                            <th>Point</th>
                                                                                            <th>Hasil</th>
                                                                                        </tr>
                                                                                        <?php $nr2 = 1; ?>
                                                                                        @if($soalRemed)
                                                                                            @foreach($soalRemed as $sr => $isiSR)
                                                                                                @if($isiSR->id_ujian_remedial == $isiJR2->id_ujian_remedial)
                                                                                                    <tr>
                                                                                                        <td> <?php echo $nr2++; ?> </td>
                                                                                                        <td> {!! $isiSR->bankSoal->isi_soal !!} </td>
                                                                                                        <td>
                                                                                                            @foreach($jawabanRemed as $jr2x => $isiJR2X)
                                                                                                                @if($isiJR2X->id_siswa == $isiN['id_siswa'])
                                                                                                                    @if($isiJR2X->id_soal_remedial == $isiSR->id_soal_remedial)
                                                                                                                        {!! $isiJR2X->jawaban_siswa !!}
                                                                                                                    @endif
                                                                                                                @endif
                                                                                                            @endforeach
                                                                                                        </td>
                                                                                                        <td>
                                                                                                            {!! $jawaban_benar_remed[$sr] !!}
                                                                                                        </td>
                                                                                                        <td> {{ $isiSR->point }}</td>
                                                                                                        <td>
                                                                                                            @foreach($jawabanRemed as $jr2x => $isiJR2X)
                                                                                                                @if($isiJR2X->id_siswa == $isiN->id_siswa)
                                                                                                                    @if($isiJR2X->id_soal_remedial == $isiSR->id_soal_remedial)
                                                                                                                        @if($isiJR2X->jawaban_siswa == $jawaban_benar_remed[$sr])
                                                                                                                            <span class="text-success">Benar</span>
                                                                                                                        @else
                                                                                                                            <span class="text-danger">Salah</span>
                                                                                                                        @endif
                                                                                                                    @endif
                                                                                                                @endif
                                                                                                            @endforeach   
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                @endif
                                                                                            @endforeach
                                                                                        @endif
                                                                                    </table>

                                                                                    <table class="table table-bordered">
                                                                                        <tr>
                                                                                            <th>Jumlah Benar</th>
                                                                                            <th>Jumlah Salah</th>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td>{{ $isiJR2->jawaban_benar }}</td>
                                                                                            <td>{{ $isiJR2->jawaban_salah }}</td>
                                                                                        </tr>
                                                                                    </table>
                                                                                </div>
                                                                            @elseif($jr2 == count($jumlahRemed)-1)
                                                                                <div role="tabpanel" class="tab-pane fade" id="remed2_{{$ni}}">
                                                                                    <table class="table table-bordered">
                                                                                        <tr>
                                                                                            <th> No </th>
                                                                                            <th> Soal </th>
                                                                                            <th> Jawaban Siswa </th>
                                                                                            <th> Jawaban Benar </th>
                                                                                            <th> Point </th>
                                                                                            <th> Hasil </th>
                                                                                        </tr>
                                                                                    </table>
                                                                                </div>
                                                                            @endif
                                                                        @endforeach
                                                                    @else
                                                                        <div role="tabpanel" class="tab-pane fade" id="remed2_{{$ni}}">
                                                                            <table class="table table-bordered">
                                                                                <tr>
                                                                                    <th> No </th>
                                                                                    <th> Soal </th>
                                                                                    <th> Jawaban Siswa </th>
                                                                                    <th> Jawaban Benar </th>
                                                                                    <th> Point </th>
                                                                                    <th> Hasil </th>
                                                                                </tr>
                                                                            </table>
                                                                        </div>
                                                                    @endif

                                                                    @if(count($jumlahRemed) > 0)
                                                                        @foreach($jumlahRemed as $jr3 => $isiJR3)
                                                                            @if($isiN['id_siswa'] == $isiJR3['id_siswa'] && $isiJR3['remed_ke'] == 3)
                                                                                <div role="tabpanel" class="tab-pane fade" id="remed3_{{$ni}}">
                                                                                    <table class="table table-bordered">
                                                                                        <tr>
                                                                                            <th> No. </th>
                                                                                            <th> Soal </th>
                                                                                            <th> Jawaban Siswa </th>
                                                                                            <th> Jawaban Benar </th>
                                                                                            <th> Point </th>
                                                                                            <th> Hasil </th>
                                                                                        </tr>
                                                                                        <?php $nr3 = 1; ?>
                                                                                        @if($soalRemed)
                                                                                            @foreach($soalRemed as $sr => $isiSR)
                                                                                                @if($isiSR->id_ujian_remedial == $isiJR3->id_ujian_remedial)
                                                                                                    <tr>
                                                                                                        <td> <?php echo $nr3++; ?> </td>
                                                                                                        <td> {!! $isiSR->bankSoal->isi_soal !!} </td>
                                                                                                        <td>
                                                                                                            @foreach($jawabanRemed as $jr3x => $isiJR3X)
                                                                                                                @if($isiJR3X->id_siswa == $isiN['id_siswa'])
                                                                                                                    @if($isiJR3X->id_soal_remedial == $isiSR->id_soal_remedial)
                                                                                                                        {!! $isiJR3X->jawaban_siswa !!}
                                                                                                                    @endif
                                                                                                                @endif
                                                                                                            @endforeach
                                                                                                        </td>
                                                                                                        <td>
                                                                                                            {!! $jawaban_benar_remed[$sr] !!}
                                                                                                        </td>
                                                                                                        <td>
                                                                                                            {{ $isiSR->point }}
                                                                                                        </td>
                                                                                                        <td>
                                                                                                            @foreach($jawabanRemed as $jr3x => $isiJR3X)
                                                                                                                @if($isiJR3X->id_siswa == $isiN->id_siswa)
                                                                                                                    @if($isiJR3X->id_soal_remedial == $isiSR->id_soal_remedial)
                                                                                                                        @if($isiJR3X->jawaban_siswa == $jawaban_benar_remed[$sr])
                                                                                                                            <span class="text-success">Benar</span>
                                                                                                                        @else
                                                                                                                            <span class="text-danger">Salah</span>
                                                                                                                        @endif
                                                                                                                    @endif
                                                                                                                @endif
                                                                                                            @endforeach
                                                                                                        </td>  
                                                                                                    </tr>
                                                                                                @endif
                                                                                            @endforeach
                                                                                        @endif
                                                                                    </table>

                                                                                    <table class="table table-bordered">
                                                                                        <tr>
                                                                                            <th>Jumlah Benar</th>
                                                                                            <th>Jumlah Salah</th>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td>{{ $isiJR3->jawaban_benar }}</td>
                                                                                            <td>{{ $isiJR3->jawaban_salah }}</td>
                                                                                        </tr>
                                                                                    </table>
                                                                                </div>
                                                                            @elseif($jr3 == count($jumlahRemed)-1)
                                                                                <div role="tabpanel" class="tab-pane fade" id="remed3_{{$ni}}">
                                                                                    <table class="table table-bordered">
                                                                                        <tr>
                                                                                            <th> No. </th>
                                                                                            <th> Soal </th>
                                                                                            <th> Jawaban Siswa </th>
                                                                                            <th> Jawaban Benar </th>
                                                                                            <th> Point </th>
                                                                                            <th> Hasil </th>
                                                                                        </tr>
                                                                                    </table>
                                                                                </div>
                                                                            @endif
                                                                        @endforeach
                                                                    @else
                                                                        <div role="tabpanel" class="tab-pane fade" id="remed3_{{$ni}}">
                                                                            <table class="table table-bordered">
                                                                                <tr>
                                                                                    <th> No. </th>
                                                                                    <th> Soal </th>
                                                                                    <th> Jawaban Siswa </th>
                                                                                    <th> Jawaban Benar </th>
                                                                                    <th> Point </th>
                                                                                    <th> Hasil </th>
                                                                                </tr>
                                                                            </table>
                                                                        </div>
                                                                    @endif

                                                                </div>
                                                            </td>
                                                        </tr>   
                                                    </tbody>
                                                @endif
                                                <?php if($index < count($jumlahNilai)-1){ $index++;} ?>
                                            @endforeach
                                        </table>
                                    </div>
                                @endforeach
                            @else
                                <strong><p>Data tidak tersedia.</p></strong>
                            @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
@section('js')
@include('layouts/navbar/navbar_admin_footer')
    <script type="text/javascript">
        $(window).on('load', function(){
            $('#sidebar-menu-ujian').addClass('active');
        });

        $(document).ready(function(){
            $('.block-fade').on('click', function(){
                var $index  = $(this).attr('data-panel');

                if($(this).parent().attr('aria-expanded') == 'false'){
                    $('#'+$index).fadeIn(function(){
                        $(this).parent().siblings().attr('aria-expanded', 'false');
                        $(this).parent().siblings().children('.collapse').fadeOut();
                        $('.block-parent.active').removeClass('active');

                        $(this).parent().attr('aria-expanded', 'true');
                        $(this).parent().addClass('block-parent active');
                    });
                }else{
                    $('#'+$index).fadeOut(function(){
                        $(this).parent().attr('aria-expanded', 'false');
                        $(this).parent().removeClass('active');
                    });
                }
            });

            var $dataChart = {!! json_encode($chartPerKelas) !!};
            var $daftar_kelas = [];var $label;var $daftar_nilai = [];
            $dataChart.forEach(function(realData){
                $daftar_kelas.push(realData.kelas);
                $label = realData.judul;
                $daftar_nilai.push(realData.rataNilai);
            });
            var ctx = document.getElementById('chartPerKelas').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels:$daftar_kelas,
                    datasets: [{
                        label: 'Rata - Rata Nilai',
                        data: $daftar_nilai,
                        borderWidth: 1,
                        backgroundColor: 'lightblue'
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero:true
                            }
                        }]
                    }
                }
                
            });
               
        });
    </script>
@endsection