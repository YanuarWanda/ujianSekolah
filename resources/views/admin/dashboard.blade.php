@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    <a href="/kelola-guru" class="btn btn-primary">Kelola Guru</a>
                    <br><br>
                    <a href="/kelola-siswa" class="btn btn-success">Kelola Siswa</a>
                    <br><br>
                    <a href="/kelola-ujian" class="btn btn-danger">Kelola Ujian</a>
                    <br><br>
                    <a href="/kelola-jurusan" class="btn btn-info">Kelola Jurusan</a>
                    <br><br>
                    <a href="/kelola-kelas" class="btn btn-warning">Kelola Kelas</a>
                    <br><br>
                    <a href="/kelola-bidang" class="btn btn-primary">Kelola Bidang Keahlian</a>
                    <br><br>
                    <a href="/kelola-mapel" class="btn btn-success">Kelola Mata Pelajaran</a>
                    <br><br>
                    <a href="/kelola-guru/import" class="btn btn-default">Import data Guru</a>
                    <br><br>
                    <a href="/kelola-siswa/import" class="btn btn-default">Import data Siswa</a>
                </div>
            </div>
        </div>

        {{-- Chart --}}
        <div class="col-md-8">
            <div class="panel panel-primary">
                <div class="panel-heading">Charts</div>

                <div class="panel-body">
                    <canvas id="canvas" width="600"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
var url = "{{ route('data-nilai') }}";
var nama = new Array();
var Labels = new Array();
var nilai = new Array();
var jawaban_benar = new Array();
var jawaban_salah = new Array();
$(document).ready(function(){
  $.get(url, function(response){
    response.forEach(function(data){
        nama.push(data.nama);
        Labels.push(data.judul_ujian);
        nilai.push(data.nilai);
        jawaban_benar.push(data.jawaban_benar);
        jawaban_salah.push(data.jawaban_salah);
    });
    var ctx = document.getElementById("canvas").getContext('2d');
        var myChart = new Chart(ctx, {
          type: 'bar',
          data: {
              labels:nama,
              datasets: [{
                label: 'Nilai Ujian',
                data: nilai,
                borderWidth: 1,
                backgroundColor: 'lightblue'
              },{
                label: 'Jawaban Benar',
                data: jawaban_benar,
                borderWidth: 1,
                backgroundColor: 'green'
              },{
                label: 'Jawaban Salah',
                data: jawaban_salah,
                borderWidth: 1,
                backgroundColor: 'red'
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
});
</script>
@stop