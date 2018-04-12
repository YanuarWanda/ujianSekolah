@extends('layouts.app')

@section('css')
<script>
window.onbeforeunload = function(e) {
    var dialogText = 'Yakin?';
    e.returnValue = dialogText;
    return dialogText;
}

</script>
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
                @if($ujian->id_ujian_remedial)
                <form class="form-horizontal" id="ujian" method="POST" action="{{ url('/remed/submit', base64_encode($ujian->id_ujian_remedial))  }}" onsubmit="resetStorage();">
                @else
                <form class="form-horizontal" id="ujian" method="POST" action="{{ url('/soal/submit', base64_encode($ujian->id_ujian)) }}" onsubmit="resetStorage();">
                @endif
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
                                shuffle($pilihanAsli);
                            ?>
                            <div>
                                @if ($isi->bankSoal['tipe'] != 'MC')
                                    @foreach($pilihanAsli as $p)
                                        <div class="radio">
                                            <label><input type="radio" class="jawaban_{{ $isi->id_bank_soal }}" name="jawaban_{{ $isi->id_bank_soal }}" value="{{ $p }}" onclick="simpanJawaban('jawaban_'+{{ Auth::user()->id_users }}+'_'+{{ $isi->id_ujian }}+'_'+{{ $isi->id_bank_soal }}, '{{ $p }}' )" autocomplete="off">{!! $p !!}</label>
                                        </div>
                                    @endforeach
                                @else
                                    @foreach($pilihanAsli as $p)
                                        <div class="checkbox">
                                            <label><input type="checkbox" class="jawaban_{{ $isi->id_bank_soal }}" name="jawaban_{{ $isi->id_bank_soal }}[]" value="{{ $p }}" onclick="simpanJawabanMC('jawaban_'+{{ Auth::user()->id_users }}+'_'+{{ $isi->id_ujian }}+'_'+{{ $isi->id_bank_soal }}, '{{ $p }}' )" autocomplete="off">{!! $p !!}</label>
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
                            @if($ujian->id_ujian_remedial)
                                @for($a = 1; $a <= count($ujian->soalRemed); $a++)
                                    <button style="margin: 0; margin-left: 10px; border-radius: 0px" class="btn btn-default btnPindah" value="{{ $a }}" data-panel="Soal_{{$a-1}}">
                                        {{ $a }}
                                    </button>
                                @endfor
                            @else
                                @for($a = 1; $a<= count($ujian->soal) ;$a++)
                                {{-- {{ count($ujian->soal) }} --}}
                                    <button style="margin: 0; margin-left: 10px; border-radius: 0px" class="btn btn-default btnPindah" value="{{ $a }}" data-panel="Soal_{{$a-1}}">
                                         {{ $a }}
                                     </button>
                                @endfor
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4>Detail Ujian</h4>
                </div>

                <div class="panel-body">
                    @if($ujian->id_ujian_remedial)
                        <p>Ulangan : {{ $ujian->ujian->judul_ujian }}</p>
                        @if($ujian->ujian->guru['nip'])
                            <p>NIP :  {{ $ujian->ujian->guru['nip'] }}</p>
                            <p>Nama  : {{ $ujian->ujian->guru->nama }}</p>
                        @endif
                    @else
                        <p>Ulangan : {{ $ujian->judul_ujian }}</p>
                        @if($ujian->guru['nip'])
                            <p>NIP : {{ $ujian->guru['nip'] }}</p>
                            <p>Nama : {{ $ujian->guru->nama }}</p>
                        @endif
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
    // console.log(sisa_waktu);

    if(sisa_waktu == '0:0:0') {
        swal('', 'Waktu Pengerjaan Habis !', 'warning').then((selesai) => {
            if(selesai) {
                document.getElementById('ujian').submit();
            }
        });
    }
}

var $soalPNG = {!! $soalPG !!};
var $soalMNC = {!! $soalMC !!};
var $idUser  = {{ Auth::user()->id_users }};
var $idUjian = {{ $ujian->id_ujian }};

$(window).on('beforeunload', function(){
    localStorage.setItem('waktu_'+{{ $ujian->id_ujian }}, count);
});

$(window).on('load', function(){
    // localStorage.clear();
    var waktu = localStorage.getItem('waktu_'+{{ $ujian->id_ujian }});
    if(waktu > 0){
        count = waktu;
    }else{
        count = {{ $sisa_waktu }};
    }

    $soalPNG.forEach(function(realData){
        $('.jawaban_'+realData.id_bank_soal).each(function(){
            if($(this).val() == localStorage.getItem('jawaban_'+$idUser+'_'+$idUjian+'_'+realData.id_bank_soal)){
                $(this).attr('checked', 'checked');
            }
        });
    });

    $soalMNC.forEach(function(realData){
        $('.jawaban_'+realData.id_bank_soal).each(function(){
            var $isiDiPotong = localStorage.getItem('jawaban_'+$idUser+'_'+$idUjian+'_'+realData.id_bank_soal).split(', ');
            console.log($isiDiPotong);
            for(var z=0;z<$isiDiPotong.length;z++){
                if($(this).val() == $isiDiPotong[z]){
                    $(this).attr('checked', 'checked');
                }
            }
        });
    });
});

function simpanJawaban(name, value){
    localStorage.setItem(name, value);
}

function simpanJawabanMC(name, value){
    var $isi;
    if(localStorage.getItem(name) != null){
        $isi = localStorage.getItem(name).split(', ');
        for(var i=0;i<$isi.length;i++){
            if($isi[i] == value){
                // console.log("Sebelum di splice : "+$isi);
                $isi.splice(i, 1);
                // console.log("Sesudah di ssplice : "+$isi);
                $isiJ = $isi.join(', ');
                // console.log("Pas di join : "+$isiJ);
                localStorage.setItem(name, $isiJ);
                break;
            }else if(i === $isi.length-1 && $isi[i] != value){
                localStorage.setItem(name, localStorage.getItem(name)+', '+value);
            }
            // console.log("Hasil : "+localStorage.getItem(name));
        }
    }else{
        localStorage.setItem(name, value);
    }
}

function resetStorage(){
    localStorage.clear();
}

</script>
@endsection
