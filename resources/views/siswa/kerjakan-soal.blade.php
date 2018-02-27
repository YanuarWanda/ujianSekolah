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

                @foreach($soalFull as $s => $isi)
                <div class="panel-body" id="Soal_{{$s}}" @if($s == '0') style="display:block" @else style="display:none" @endif>
                    <h4>{!! $isi->isi_soal !!}</h4>
                    <p></p>

                    <hr>

                    <h4>Jawaban</h4>
                        <?php $pilihanAsli = explode(' ,  ', $soalFull[$s]['pilihan']);?>
                        <div>
                            @foreach($pilihanAsli as $p)
                                <div class="radio">
                                    <label><input type="radio" name="optradio">{!! $p !!}</label>
                                </div>
                            @endforeach
                        </div>

                        <div class="form-group pull-right">
                          <button class="btn btn-success nextSoal" data-panel="Soal_{{$s}}">Next</button>
                        </div>
                    </form>
                </div>
                @endforeach

            </div>
        </div>
        <div class="col-md-4 detail">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="row">
                        <div class="col">
                        @for($a = 1; $a<= count($ujian->soal) ;$a++)
                        {{-- {{ count($ujian->soal) }} --}}
                            @if($a == count($ujian->soal))
                                <button type="button" name="button"></button>
                            @else
                                <button style="margin: 0;margin-left: 5px; border-radius: 0px" class="btn btn-default btnPindah" value="{{ $a }}" data-panel="Soal_{{$a-1}}">
                                     {{ $a }}
                                 </button>
                            @endif

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
                    <p>NIP : {{ $ujian->guru->nip }}</p>
                    <p>Nama  : {{ $ujian->guru->nama }}</p>
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
    // console.log(sisa_waktu);
}
</script>
@endsection
