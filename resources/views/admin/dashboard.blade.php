@extends('layouts.app')

@section('content')
{{-- Chart --}}
<div class="panel panel-default">
    <div class="panel-heading">Contoh GRAFIK</div>

    <div class="panel-body">
        <div class="row">
          <div class="col-md-6">
            <canvas id="ujian1"></canvas>
          </div>
          <div class="col-md-6">
            <canvas id="ujian2"></canvas>
          </div>
        </div>
    </div>
</div>
{{-- Chart --}}
@endsection

@section('js')
<script>

// $(document).ready(function(){

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
// });
</script>
@stop