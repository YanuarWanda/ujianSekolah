@extends('layouts.app')

@section('css')
<style>
    .detail p{
        padding-bottom: 9px;
        border-bottom: 1px solid black;
    }
    .radio{
        text-decoration:none;      
    }
    .sudahDikerjakan{
        background-color: #22cc22;
    }
    .sedangDikerjakan{
        background-color: rgba(100, 100, 250, 0.5) !important;
    }

    .btnPindah{
        width: 35px;
        height: 35px;
        border-radius: 0px;
        margin-bottom: 5px;
    }
</style>
@endsection

@section('content')
@include('layouts/navbar/navbar_siswa')
<div class="container text-dark p-5">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <strong>Sisa Waktu : <span class="text-danger" id="pageTimer"></span></strong>
                    <div class="float-right">No. <strong id="indikatorNomor">1</strong></div>
                </div>
                @if($ujian->id_ujian_remedial)
                <form action="{{ url('siswa/remed/submit', base64_encode($ujian->id_ujian_remedial)) }}" onsubmit="resetStorage();" method="POST">
                @else
                <form action="{{ url('siswa/ujian/submit', base64_encode($ujian->id_ujian)) }}" onsubmit="resetStorage();" method="POST">
                @endif
                    {{ csrf_field() }}
                    @foreach($soalFull as $s => $sValue)
                    <div class="card-body" id="Soal_{{$s}}" @if($s == '0') style="display:block" @else style="display:none" @endif>
                        <h4 class="text-center">{!! $sValue->bankSoal->isi_soal !!}</h4>
                        <hr>
                        <h4>Pilihan</h4>
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
                            @if($sValue->bankSoal->tipe != 'MC')
                                @foreach($pilihanAsli as $p)
                                    <div class="radio">
                                        <label class="radio-inline"><input type="radio" name="jawaban_{{$sValue->id_bank_soal}}" class="jawaban_{{$sValue->id_bank_soal}} Jawab" value="{{ $p }}" onclick="simpanJawaban('jawaban_'+{{ Auth::user()->id_users }}+'_'+{{ $sValue->id_ujian_remedial }}+'_'+{{ $sValue->id_bank_soal }}, '{{ $p }}' )" autocomplete="off" data-pindah="{{ $sValue->id_bank_soal }}">{!! $p !!}</label>
                                    </div>
                                @endforeach
                            @else
                                @foreach($pilihanAsli as $p)
                                    <div class="checkbox">
                                        <label><input type="checkbox" name="jawaban_{{$sValue->id_bank_soal}}[]" class="jawaban_{{$sValue->id_bank_soal}} Jawab" value="{{ $p }}" onclick="simpanJawabanMC('jawaban_'+{{ Auth::user()->id_users }}+'_'+{{ $sValue->id_ujian_remedial }}+'_'+{{ $sValue->id_bank_soal }}, '{{ $p }}' )" autocomplete="off" data-pindah="{{ $sValue->id_bank_soal }}">{!! $p !!}</label>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        
                        @if($s == count($soalFull)-1)
                            <div class="form-group float-right">
                                <button type="submit" class="btn btn-primary"><i class="fas fa-plane"></i>&nbsp;Submit</button>
                            </div>
                        @else
                            <div class="form-group float-right">
                                <a class="btn btn-success nextSoal text-light" data-panel="Soal_{{$s}}"><i class="fas fa-arrow-right"></i>&nbsp;Next</a>
                            </div>
                        @endif
                    </div>
                    @endforeach
                </form>
            </div>
        </div>
        <div class="col-md-4 detail">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            @if($ujian->id_ujian_remedial)
                                @foreach($soalFull as $sr => $srIsi)
                                    <button class="btn btn-default btnPindah pindah_{{$sr}}" id="pindah_{{$srIsi->id_bank_soal}}" value="{{$sr+1}}" data-panel="Soal_{{$sr}}" @if($sr == 0) style="background-color:rgba(100, 100, 250, 0.5);" @endif>
                                        {{$sr+1}}
                                    </button>
                                @endforeach
                            @else
                                @foreach($soalFull as $a => $aIsi)
                                    <button class="btn btn-default btnPindah pindah_{{$a}}" id="pindah_{{$aIsi->id_bank_soal}}" value="{{$a+1}}" data-panel="Soal_{{$a}}" @if($a == 0) style="background-color:rgba(100, 100, 250, 0.5);" @endif>
                                        {{$a+1}}
                                    </button>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mt-2">
                <div class="card-header">
                    <h4 class="text-center">Detail Ujian</h4>
                </div>

                <div class="card-body">

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    $('.Jawab').on('click', function(){
        var $indikator = $(this).attr('data-pindah');
        $('#pindah_'+$indikator).addClass('sudahDikerjakan');
        simpanJawaban('pindah_'+$indikator+'_'+$idUser+'_'+$idUjian, 'pindah_'+$indikator+'_'+$idUjian+'_'+$idUser);
    }); 

    $('.btnPindah').on('click', function(){
        $('.btnPindah').attr('style', '');
        $('.btnPindah').removeClass('sedangDikerjakan');
        $(this).addClass('sedangDikerjakan');
    });

    $(window).on('unbeforeunload', function(e){
        var dialogText = 'Yakin nih?';
        e.returnValue = dialogText;
        return dialogText;
    });

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
    var $soal    = {!! $soalFull !!};
    var $idUser  = {{ Auth::user()->id_users }};
    var $idUjian = {{ $ujian->id_ujian_remedial }};

    $(window).on('beforeunload', function(){
        localStorage.setItem('waktu_'+{{ $ujian->id_ujian_remedial }}, count);
    });

    $(window).on('load', function(){
        // localStorage.clear();
        // alert($idUjian);
        var waktu = localStorage.getItem('waktu_'+{{ $ujian->id_ujian_remedial }});
        if(waktu > 0){
            count = waktu;
        }else{
            count = {{ $sisa_waktu }};
        }

        if($soal.length > 0){
            $soal.forEach(function(realData){
                if(localStorage.getItem('pindah_'+realData.id_bank_soal+'_'+$idUser+'_'+$idUjian)){
                    if(localStorage.getItem('jawaban_'+$idUser+'_'+$idUjian+'_'+realData.id_bank_soal).length > 0){    
                        $('#pindah_'+realData.id_bank_soal).addClass('sudahDikerjakan');
                    }
                }
            });
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
                // console.log($isiDiPotong);
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

    // Animasi pas pilih next pas kerjakan soal.
    $('.nextSoal').on('click', function(){
        var $index = $(this).attr('data-panel');
        var $nowIndex = $index.split('_', 3);
        var $nextIndex = parseInt($nowIndex['1'])+1;
        $('#Soal_'+$nowIndex['1']).slideUp(500, function(){
            $('#Soal_'+$nextIndex).slideDown(500);
        });

        $('.btnPindah').removeClass('sedangDikerjakan');
        $('.btnPindah').attr('style', '');
        $('.pindah_'+$nextIndex).addClass('sedangDikerjakan');
        // localStorage.clear();                
    });

    // Animasi pas pilih nomor soal pas kerjakan soal.
    $('.btnPindah').on('click', function(){
        var $nowIndex = $('.card-body:visible').attr('id');
        var $index = $(this).attr('data-panel');
        $('#'+$nowIndex).slideUp(500, function(){
            $('#'+$index).slideDown(500);
        });
    });
</script>
@endsection