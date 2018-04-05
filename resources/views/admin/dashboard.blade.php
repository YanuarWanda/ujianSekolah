@extends('layouts.app')

@section('css')
    
@endsection

@section('content')
<div class="col-md-3">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    <a href="/kelola-guru" class="btn btn-primary btn-block">Kelola Guru</a>
                    <a href="/kelola-siswa" class="btn btn-success btn-block">Kelola Siswa</a>
                    <a href="/kelola-ujian" class="btn btn-danger btn-block">Kelola Ujian</a>
                    <a href="/kelola-jurusan" class="btn btn-info btn-block">Kelola Jurusan</a>
                    <a href="/kelola-kelas" class="btn btn-warning btn-block">Kelola Kelas</a>
                    <a href="/kelola-bidang" class="btn btn-primary btn-block">Kelola Bidang Keahlian</a>
                    <a href="/kelola-mapel" class="btn btn-success btn-block">Kelola Mata Pelajaran</a>
                    <a href="/kelola-guru/import" class="btn btn-default btn-block">Import data Guru</a>
                    <a href="/kelola-siswa/import" class="btn btn-default btn-block">Import data Siswa</a>
                </div>
            </div>
        </div>
<div class="container">
    <div class="row">

        {{-- Chart --}}
        <div class="col-md-7">    
            <center><h4>Grafik Nilai Rata-Rata per Ujian</h4></center>
            <div class="row">
                <div class="col-md-12 chart">
                    <div class="panel panel-danger">
                        <div class="panel-heading">Nilai rata-rata <p id="judul-ujian-1"></p></div>

                        <div class="panel-body">
                            <canvas id="ujian1" height="117" width="600"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 chart">
                    <div class="panel panel-primary">
                        <div class="panel-heading">Nilai rata-rata <p id="judul-ujian-2"></p></div>

                        <div class="panel-body">
                            <canvas id="ujian2" width="600"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 chart">
                    <div class="panel panel-success">
                        <div class="panel-heading">Nilai rata-rata <p id="judul-ujian-3"></p></div>

                        <div class="panel-body">
                            <canvas id="ujian3" width="600"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
  <script>

  $(document).ready(function(){

    var url = "{{ route('data-nilai') }}";
    var label;
    var daftarChart = ['ujian1', 'ujian2', 'ujian3'];
    // console.log(daftarChart);
    $.get(url, function(response){
      // console.log(response);
      // response.forEach(function(data){
        for(var i=0, len = response.length; i<len;i++) {
        // Chart 1
        var nama_kelas = [];
        
        var nilai = [];

        // console.log(data);

        response[i].forEach(function(realData){
          // console.log(realData);
          nama_kelas.push(realData.nama_kelas);
          label = realData.judul_ujian;
          nilai.push(realData.nilai_rata_rata);
        });

        var ctx = document.getElementById(daftarChart[i]).getContext('2d');
        var myChart = new Chart(ctx, {
          type: 'bar',
          data: {
              labels:nama_kelas,
              datasets: [{
                label: label,
                data: nilai,
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
        // console.log('judul-ujian-'+i);
        $('#judul-ujian-'+(i+1)).text(label);
      }

    });
  });
  </script>
@stop