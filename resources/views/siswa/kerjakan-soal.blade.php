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
    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <strong>Sisa waktu : <span style="color: orange;" id="pageTimer"></span></strong>
                </div>

                <div class="panel-body">
                </div>
            </div>
        </div>
        <div class="col-md-4 detail">
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
var count = 3600;
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
}
</script>
@endsection