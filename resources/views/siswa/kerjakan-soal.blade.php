@extends('layouts.app')

@section('css')
<style type="text/css">
    .detail p {
        padding-bottom: 9px;
        border-bottom: 1px solid black;
    }
</style>
@endsection

@section('content')
<div class="container">
    {{-- <div class="row">
        <div class="col-md-12">

        </div>
    </div> --}}

    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <strong id="coba">Sisa waktu : <span style="color: orange;" id="pageTimer"></span></strong>
                </div>

                <form class="form-horizontal" id="ujian" method="POST" action="{{ url('/soal/submit', base64_encode($ujian->id_ujian)) }}">
                    {{ csrf_field() }}
                    @foreach($soalFull as $s => $isi)
                    <div class="panel-body" id="Soal_{{$s}}" @if($s == '0') style="display:block" @else style="display:none" @endif>
                            <h4 class="text-center">{!! $isi->bankSoal['isi_soal'] !!}</h4>

                            <hr>

                            <h4>Jawaban</h4>
                            <?php
                                $pilihanAsli = explode(' ,  ', $soalFull[$s]['bankSoal']['pilihan']);
                                foreach($pilihanAsli as $pa => $isiPA){
                                    if($isiPA == ''){
                                        unset($pilihanAsli[$pa]);
                                    }
                                }
                            ?>
                            <div>
                                @if ($isi->bankSoal['tipe'] != 'MC')
                                    @foreach($pilihanAsli as $p)
                                        <div class="radio">
                                            <label><input type="radio" name="jawaban_{{$s}}" value="{{ $p }}">{!! $p !!}</label>
                                        </div>
                                    @endforeach
                                @else
                                    @foreach($pilihanAsli as $p)
                                        <div class="checkbox">
                                            <label><input type="checkbox" name="jawaban_{{$s}}[]" value="{{ $p }}">{!! $p !!}</label>
                                        </div>
                                    @endforeach
                                @endif
                            </div>

                            @if($s == count($soalFull)-1)
                                <div class="form-group pull-right" style="margin-right: 20px">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            @else
                                <div class="form-group pull-right" style="margin-right: 20px">
                                  <a class="btn btn-success nextSoal" data-panel="Soal_{{$s}}">Next</a>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </form>

            </div>
        </div>
        <div class="col-md-4 detail">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="row">
                        <div class="col">
                        @for($a = 1; $a<= count($ujian->soal) ;$a++)
                        {{-- {{ count($ujian->soal) }} --}}
                            <button style="margin: 0; margin-left: 10px; border-radius: 0px" class="btn btn-default btnPindah" value="{{ $a }}" data-panel="Soal_{{$a-1}}">
                                 {{ $a }}
                             </button>
                        @endfor
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4>Detail Ujian</h4>
                </div>

                <div class="panel-body">
                    <p>Ulangan : {{ $ujian->judul_ujian }}</p>
                    @if($ujian->guru['nip'])
                    <p>NIP :  {{ $ujian->guru['nip'] }}</p>
                    <p>Nama  : {{ $ujian->guru->nama }}</p>
                    @endif
                    <p>Waktu Pengerjaan : {{ $ujian->waktu_pengerjaan }}</p>
                    <p>Catatan : {{ $ujian->catatan }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script type="text/javascript">
var count = {{ $sisa_waktu }}; // 3600s
// console.log(count);
var counter = setInterval(timer, 1000); //1000 will  run it every 1 second

function timer() {
    count = count - 1;
    if (count == -1) {
        clearInterval(counter);
        return;
    }

    var seconds = count % 60;
    var minutes = Math.floor(count / 60);
    var hours = Math.floor(minutes / 60);
    minutes %= 60;
    hours %= 60;

    document.getElementById("pageTimer").innerHTML = hours + " Jam " + minutes + " Menit " + seconds + " Detik ";
    var sisa_waktu = hours + ":" + minutes + ":" + seconds;
    console.log(sisa_waktu);

    if(sisa_waktu == '0:0:0') {
        swal('', 'Waktu Pengerjaan Habis !', 'warning').then((selesai) => {
            if(selesai) {
                document.getElementById('ujian').submit();
            }
        });
    }
}
</script>
@endsection
