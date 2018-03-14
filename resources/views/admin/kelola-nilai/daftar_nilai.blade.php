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
    <div class="container">
        <a href="{{url('/daftar-nilai/export', Request::segment(2))}}" class="btn btn-primary btn-fixed-bottom-right z-top">Export Nilai</a>
        <div class="row">
            <div class="col-sm-12">
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

                                    <div class="blockKelas" id="Kelas_{{$n}}">
                                        <table class="table table-bordered" id="tableNilai">
                                            <?php $index=0; ?>
                                                <thead>
                                                    <tr>
                                                        <th>No.</th>
                                                        <th>Nama</th>
                                                        <th>Jumlah Benar</th>
                                                        <th>Jumlah Salah</th>
                                                        <th>Nilai Ujian</th>
                                                        <th>Nilai Remed</th>
                                                    </tr>
                                                </thead>
                                            @foreach($nilai as $ni => $isiN)
                                                @if($isiN['id_kelas'] == $isiJumlah['id_kelas'])
                                                    <tbody aria-expanded="false">
                                                        <tr class="block-fade" data-panel="Siswa_{{$ni}}">
                                                            <td><?php echo $no;$no++; ?></td>
                                                            <td>{{$isiN->nama}}</td>
                                                            <td>{{$isiN['jawaban_benar']}}</td>
                                                            <td>{{$isiN['jawaban_salah']}}</td>
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
                                                                @if($isiNR['nilai_remedial'] < $isiN->ujian->kkm)
                                                                    <td class="text-red">
                                                                        {{ $isiNR['nilai_remedial'] }}
                                                                    </td>
                                                                @else
                                                                    <td class="text-green">
                                                                        {{ $isiNR['nilai_remedial'] }}
                                                                    </td>
                                                                @endif
                                                            @endforeach
                                                        </tr>
                                                        <tr id="Siswa_{{$ni}}" class="collapse">
                                                            <td colspan=6>
                                                                <ul class="nav nav-tabs" role="tablist">
                                                                    <li role="presentation" class="active"><a href="#ujian_{{$ni}}" aria-controls="ujian_{{$ni}}" role="tab" data-toggle="tab">Ujian</a></li>
                                                                    <li role="presentation"><a href="#remed_{{$ni}}" aria-controls="remed_{{$ni}}" role="tab" data-toggle="tab">Remedial</a></li>
                                                                </ul>
                                                                <div class="tab-content">
                                                                    <div role="tabpanel" class="tab-pane fade in active" id="ujian_{{$ni}}">
                                                                        <table class="table table-bordered">
                                                                            <tr>
                                                                                <th> No </th>
                                                                                <th> Jawaban Siswa </th>
                                                                                <th> Jawaban Benar </th>
                                                                                <th> Hasil </th>
                                                                            </tr>
                                                                        <?php $ns=1; ?>
                                                                        @foreach($soal as $s => $isiS)
                                                                            <tr>
                                                                                <td> <?php echo $ns;$ns++; ?> </td>
                                                                                <td> 
                                                                                    @foreach($jawabanUjian as $ju => $isiJU)
                                                                                        @if($isiJU->id_siswa == $isiN->id_siswa)
                                                                                            @if($isiJU->id_soal == $isiS->id_soal)
                                                                                                {{ $isiJU->jawaban_siswa }}
                                                                                            @endif
                                                                                        @endif
                                                                                    @endforeach    
                                                                                </td>
                                                                                <td> {{ $jawaban_benar[$s] }} </td>
                                                                                <td> 
                                                                                    @foreach($jawabanUjian as $ju => $isiJU)
                                                                                        @if($isiJU->id_siswa == $isiN->id_siswa)
                                                                                            @if($isiJU->id_soal == $isiS->id_soal)
                                                                                                @if($isiJU->jawaban_siswa == $jawaban_benar[$s])
                                                                                                    Benar
                                                                                                @else
                                                                                                    Salah
                                                                                                @endif
                                                                                            @endif
                                                                                        @endif
                                                                                    @endforeach    
                                                                                </td>
                                                                            </tr>    
                                                                        @endforeach
                                                                        </table>
                                                                    </div>
                                                                    <div role="tabpanel" class="tab-pane fade" id="remed_{{$ni}}">
                                                                        <table class="table table-bordered">
                                                                        <tr>
                                                                            <th> No </th>
                                                                            <th> Jawaban Siswa </th>
                                                                            <th> Jawaban Benar </th>
                                                                            <th> Hasil </th>
                                                                        </tr>
                                                                        <tr>
                                                                        <?php $nr=1; ?>
                                                                        @if($soalRemed)
                                                                            @foreach($soalRemed as $sr => $isiSR)
                                                                                <td> <?php echo $nr; ?> </td>
                                                                                <td>
                                                                                    @foreach($jawabanRemed as $jr => $isiJR)
                                                                                        @if($isiJR->id_siswa == $isiN->id_siswa)
                                                                                            @if($isiJR->id_soal_remedial == $isiSR->id_soal_remedial)
                                                                                                {{ $isiJR->jawaban_siswa }}
                                                                                            @endif
                                                                                        @endif
                                                                                    @endforeach
                                                                                </td>
                                                                                <td> {{ $jawaban_benar_remed[$s] }} </td>
                                                                                <td>
                                                                                    @foreach($jawabanRemed as $jr => $isiJR)
                                                                                        @if($isiJR->id_siswa == $isiN->id_siswa)
                                                                                            @if($isiJR->id_soal_remedial == $isiSR->id_soal_remedial)
                                                                                                @if($isiJR->jawaban_siswa == $jawaban_benar_remed[$sr])
                                                                                                    Benar
                                                                                                @else
                                                                                                    Salah
                                                                                                @endif
                                                                                            @endif
                                                                                        @endif
                                                                                    @endforeach
                                                                                </td>
                                                                            @endforeach
                                                                        @endif
                                                                        </tr>
                                                                        </table>
                                                                    </div>
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
        });
    </script>
@endsection