@extends('layouts.app')

@section('css')
<style>
.block-parent.active{
    background-color: lightgrey;
    border: none;
}
</style>
@endsection

@section('content')
    <div class="container-fluid">
        <a href="{{url('/daftar-nilai/export', Request::segment(2))}}" class="btn-lg btn-success btn-fixed-bottom">Export Nilai</a>
        <div class="row">
            <div class="col-sm-12">
                {{-- <div class="panel panel-default">
                    <div class="panel-heading">Chart Nilai Ujian Semua Siswa</div>
                    <div class="panel-body">
                        <canvas id="chartPerSiswa" width="600">
                        
                        </canvas>
                    </div>
                </div> --}}

                <div class="panel panel-default">
                    <div class="panel-heading">Chart Nilai Ujian per Kelas</div>
                    <div class="panel-body">
                        <div class="container-fluid row">
                            <div class="col-md-6 col-md-offset-3">
                                <canvas id="chartPerKelas"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">Data Nilai</div>

                    <div class="panel-body">
                        <div class="table-responsive">
                            @if(count($nilai) > 0)
                                <?php $no=1; ?>
                                @foreach($jumlahNilai as $n => $isiJumlah)
                                    <div class="block" data-panel="Kelas_{{$n}}">
                                        <button type="button" class="btn btn-primary btn-block" style="border-radius:0">{{ $isiJumlah['nama_kelas'] }}</button>
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
                                                                <td class="text-red">
                                                                    {{$isiN['nilai']}}
                                                                </td>
                                                            @else
                                                                <td class="text-green">
                                                                    {{ $isiN['nilai'] }}
                                                                </td>
                                                            @endif
                                                            
                                                            @foreach($nilaiRemed as $nr => $isiNR)    
                                                                @if($isiNR['id_siswa'] == $isiN['id_siswa'] && $isiNR['remed_ke'] == '1')
                                                                    @if($isiNR['nilai_remedial'] < $isiN->ujian->kkm)
                                                                        <td class="text-red">
                                                                            {{ $isiNR['nilai_remedial'] }}
                                                                        </td>
                                                                        <?php break; ?>
                                                                    @elseif($isiNR['nilai_remedial'] >= $isiN->ujian->kkm)
                                                                        <td class="text-green">
                                                                            {{ $isiNR['nilai_remedial'] }}
                                                                        </td>
                                                                        <?php break; ?>
                                                                    @endif
                                                                @endif
                                                            @endforeach

                                                            @foreach($nilaiRemed as $nr => $isiNR)
                                                                @if($isiNR['id_siswa'] == $isiN['id_siswa'] && $isiNR['remed_ke'] == '2')
                                                                    @if($isiNR['nilai_remedial'] < $isiN->ujian->kkm)
                                                                        <td class="text-red">
                                                                            {{ $isiNR['nilai_remedial'] }}
                                                                        </td>
                                                                    @elseif($isiNR['nilai_remedial'] >= $isiN->ujian->kkm)
                                                                        <td clas="text-green">
                                                                            {{ $isiNR['nilai_remedial'] }}
                                                                        </td>
                                                                    @endif
                                                                @endif
                                                            @endforeach

                                                            @foreach($nilaiRemed as $nr => $isiNR)
                                                                @if($isiNR['id_siswa'] == $isiN['id_siswa'] && $isiNR['remed_ke'] == '3')
                                                                    @if($isiNR['nilai_remedial'] < $isiN->ujian->kkm)
                                                                        <td class="text-red">
                                                                            {{ $isiNR['nilai_remedial'] }}
                                                                        </td>
                                                                    @elseif($isiNR['nilai_remedial'] >= $isiN->ujian->kkm)
                                                                        <td clas="text-green">
                                                                            {{ $isiNR['nilai_remedial'] }}
                                                                        </td>
                                                                    @endif
                                                                @endif
                                                            @endforeach


                                                        </tr>

                                                        <tr id="Siswa_{{$ni}}" class="collapse">
                                                            <td colspan=8>
                                                                <ul class="nav nav-tabs" role="tablist">
                                                                    <li role="presentation" class="active"><a href="#ujian_{{$ni}}" aria-controls="ujian_{{$ni}}" role="tab" data-toggle="tab">Ujian</a></li>
                                                                    <li role="presentation"><a href="#remed_{{$ni}}" aria-controls="remed_{{$ni}}" role="tab" data-toggle="tab">Remedial 1</a></li>
                                                                    <li role="presentation"><a href="#remed2_{{$ni}}" aria-controls="remed2_{{$ni}}" role="tab" data-toggle="tab">Remedial 2</a></li>
                                                                    <li role="presentation"><a href="#remed3_{{$ni}}" aria-controls="remed3_{{$ni}}" role="tab" data-toggle="tab">Remedial 3</a></li>
                                                                </ul>

                                                                <div class="tab-content">
                                                                    <div role="tabpanel" class="tab-pane fade in active" id="ujian_{{$ni}}">
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
                                                                                                    <span class="text-green">Benar</span>
                                                                                                @else
                                                                                                    <span class="text-red">Salah</span>
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
                                                                                                                    <span class="text-green">Benar</span>
                                                                                                                @else
                                                                                                                    <span class="text-red">Salah</span>
                                                                                                                @endif
                                                                                                            @endif
                                                                                                        @endif
                                                                                                    @endforeach
                                                                                                </td>
                                                                                            </tr>
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
                                                                                        <tr>
                                                                                            <?php $nr2 = 1; ?>
                                                                                            @if($soalRemed)
                                                                                                @foreach($soalRemed as $sr => $isiSR)
                                                                                                    <td> <?php echo $nr2; ?> </td>
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
                                                                                                    <td> {{ $isiJR2->point }}</td>
                                                                                                    <td>
                                                                                                        @foreach($jawabanRemed as $jr2x => $isiJR2X)
                                                                                                            @if($isiJR2X->id_siswa == $isiN->id_siswa)
                                                                                                                @if($isiJR2X->id_soal_remedial == $isiSR->id_soal_remedial)
                                                                                                                    @if($isiJR2X->jawaban_siswa == $jawaban_benar_remed[$sr])
                                                                                                                        <span class="text-green">Benar</span>
                                                                                                                    @else
                                                                                                                        <span class="text-red">Salah</span>
                                                                                                                    @endif
                                                                                                                @endif
                                                                                                            @endif
                                                                                                        @endforeach   
                                                                                                    </td>
                                                                                                @endforeach
                                                                                            @endif
                                                                                        </tr>
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
                                                                                        <tr>
                                                                                            <?php $nr3 = 1; ?>
                                                                                            @if($soalRemed)
                                                                                                @foreach($soalRemed as $sr => $isiSR)
                                                                                                    <td> <?php echo $nr3; ?> </td>
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
                                                                                                        {{ $isiJR3->point }}
                                                                                                    </td>
                                                                                                    <td>
                                                                                                        @foreach($jawabanRemed as $jr3x => $isiJR3X)
                                                                                                            @if($isiJR3X->id_siswa == $isiN->id_siswa)
                                                                                                                @if($isiJR3X->id_soal_remedial == $isiSR->id_soal_remedial)
                                                                                                                    @if($isiJR3X->jawaban_siswa == $jawaban_benar_remed[$sr])
                                                                                                                        <span class="text-green">Benar</span>
                                                                                                                    @else
                                                                                                                        <span class="text-red">Salah</span>
                                                                                                                    @endif
                                                                                                                @endif
                                                                                                            @endif
                                                                                                        @endforeach
                                                                                                    </td>  
                                                                                                @endforeach
                                                                                            @endif
                                                                                        </tr>
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
    <script type="text/javascript">
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

            // Data nilai per siswa
            var $data_siswa = {!! json_encode($daftarSiswa) !!};
            
            var $nama_siswa = [];var $label;var $nilai_siswa = [];
            $data_siswa.forEach(function(realData){
                $nama_siswa.push(realData.nama);
                $label = 'Nilai Siswa';
                $nilai_siswa.push(realData.nilai);
            });

            var ctx = document.getElementById('chartPerSiswa').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels:$nama_siswa,
                    datasets: [{
                        label: 'Nilai Siswa',
                        data: $nilai_siswa,
                        borderWidth: 1,
                        backgroundColor: 'orange',
                        fill: false,
                        borderColor: 'red'
                    }]
                }
            });
               
        });
    </script>
@stop