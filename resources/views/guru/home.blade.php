@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Rata rata nilai ujian</div>

                <div class="panel-body">
                    <canvas id="chartGuru" height="117" width="600"></canvas>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    <a href="/kelola-siswa" class="btn btn-success">Kelola Siswa</a>
                    <a href="/kelola-ujian" class="btn btn-danger">Kelola Ujian</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script type="text/javascript">
$(document).ready(function(){

    var url = "{{ route('chart-guru') }}";


    $.get(url, function(response){
        var judul_ujian = [];
        var rata_rata = [];

        response.forEach(function(data) {
            judul_ujian.push(data.judul_ujian);
            rata_rata.push(data.rata_rata);
        });

        var canvas = document.getElementById('chartGuru').getContext('2d');
        var chart = new Chart(canvas, {
            type: 'bar',
            data: {
                labels: judul_ujian,
                datasets: [{
                    label: 'Mean Nilai Ujian',
                    data: rata_rata,
                    backgroundColor: '#3498DB'
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
