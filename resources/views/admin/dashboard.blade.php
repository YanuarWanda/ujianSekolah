@extends('layouts.app')

@section('content')
{{-- Chart --}}
<div class="panel panel-default">
    <div class="panel-heading"><center><h4>Pengguna Aplikasi</h4></center></div>
    <div class="panel-body">
        <div class="container-fluid row">
          <div class="col-md-6">
            <canvas id="chart1"></canvas>
            <center><small><label class="help-block">*Data termasuk alumni</label></small></center>
          </div>

          <div class="col-md-6">
            <canvas id="chart2"></canvas>
            <center><small><label class="help-block">*Data tidak termasuk alumni</label></small></center>
          </div>
        </div>
     </div>   
</div>

<div class="panel panel-default">
    <div class="panel-heading"><center><h4>Pembuatan Soal</h4></center></div>
    <div class="panel-body">
      <div class="container-fluid row">
        <div class="col-md-8">
          <canvas id="chart3"></canvas>
        </div>

        <div class="col-md-4">
          <table class="table table-bordered">
            <caption>Rincian</caption>
              <tr>
                <td>Jumlah Ujian</td>
                <td>{{ $total_ujian }}</td>
              </tr>
              <tr>
                <td>Jumlah Ujian <span class="text-primary">(Posted)</span></td>
                <td>{{ $ujian_posted }}</td>
              </tr>
              <tr>
                <td>Ujian Terbaru</td>
                <td>{{ $ujian_terbaru }}</td>
              </tr>
              <tr>
                <td colspan="2"><a href="{{ route('ujian') }}" class="btn btn-primary btn-block">Lihat Semua</a></td>
              </tr>
          </table>
        </div>

      </div>
     </div>   
</div>
{{-- Chart --}}
@endsection

@section('js')
<script>
function chart1() {
  var data = {!! $chart !!};
  
  var hak_akses = [], jumlah = [];

  data.forEach(function(d) {
    hak_akses.push(d.hak_akses);
    jumlah.push(d.jumlah);
  });

  var canvas = document.getElementById('chart1').getContext('2d');
  var chart = new Chart(canvas, {
    type: 'pie',
    data: {
      labels: hak_akses,
      datasets: [{
        data: jumlah,
        backgroundColor: ['red', 'orange', 'lightgreen']
      }]
    }
  });
}

function chart2() {
  var data = {!! $chart2 !!};
  
  var nama_kelas = [], jumlah = [];

  data.forEach(function(d) {
    nama_kelas.push(d.nama_kelas);
    jumlah.push(d.jumlah);
  });

  var canvas = document.getElementById('chart2').getContext('2d');
  var chart = new Chart(canvas, {
    type: 'bar',
    data: {
      labels: nama_kelas,
      datasets: [{
        label:'Siswa per Kelas',
        data: jumlah,
        backgroundColor: 'pink'
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
}

function chart3() {
  var data = {!! $chart3 !!};
  
  var tanggal_pembuatan = [], jumlah = [];

  data.forEach(function(d) {
    tanggal_pembuatan.push(d.tanggal_pembuatan);
    jumlah.push(d.jumlah);
  });

  var canvas = document.getElementById('chart3').getContext('2d');
  var chart = new Chart(canvas, {
    type: 'line',
    data: {
      labels: tanggal_pembuatan,
      datasets: [{
        label:'Pembuatan Soal per Tanggal',
        data: jumlah,
        backgroundColor: 'lavender'
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
}

$(document).ready(function(){
  chart1();
  chart2();
  chart3();
});
</script>
@stop