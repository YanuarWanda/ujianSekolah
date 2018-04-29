@extends('layouts/app')

@section('css')
<style>
    .bg-image-1{
        background-image: url('/image/background/bg-5.jpg');
        background-size: cover;
        height: 250px;
        opacity: 0.8;
        transition: 1s;
    }
    .bg-image-1:hover{
        opacity: 0.5;
        transition: 1s;
    }
    .bg-image-2{
        background-image: url('/image/background/bg-4.jpg');
        background-size: cover;
        height: 250px;
        opacity: 0.8;
        transition: 1s;
    }
    .bg-image-2:hover{
        opacity: 0.5;
        transition: 1s;
    }
    .hv-center{
        position: absolute;
        top: 10%;
        left: 18%;
        transform: translate(-50%, -50%);
        color: white;
        font-family: comic-sans;
        
    }
    .bisaHover{
        cursor: pointer;
    }
    .hideung{
        background-color: rgba(0, 0, 0, 0.25);
        width: 250px;
        height: 250px;  
    }
</style>
@endsection

@section('content')
@include('layouts/navbar/navbar_guru')
<div class="container text-justify text-dark border mt-3 mb-3">
    <h1 class="text-center">Selamat Datang di U-Lah!</h1>
    <div class="row bisaHover justify-content-between">
        <div class="col-lg-6 bg-image-1" id="pindahSiswa" href="{{ url('guru/siswa') }}" data-toggle="tooltip" data-placement="left" title="Menu Siswa">
            <div class="hideung">
                <h1 class="hv-center">Siswa</h1>
            </div>
        </div>
        
        <div class="col-lg-6 bg-image-2" id="pindahUjian" href="{{ url('guru/ujian') }}" data-toggle="tooltip" data-placement="right" title="Menu Ujian">
            <div class="hideung"><h1 class="hv-center">Ujian</h1></div>
        </div>
    </div>
    <hr>
    <div class="row p-3">
        <div class="col-lg-6">
            <div class="card h-100">
                <div class="card-header text-center"><h3>Rata - Rata Nilai <strong>Ujian</strong> Terakhir</h3><small href="{{ url('guru/ujian/nilai', base64_encode($chart1['id_ujian'])) }}" data-toggle="tooltip" data-placement="bottom" title="Lihat Selengkapnya" class="bisaHover" id="selengkapnya">{{ $chart1['judul'] }}</small></div>
                <div class="card-body">
                    <canvas id="chart1"></canvas>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card h-100">
                <div class="card-header text-center"><h3>Data Nilai <strong>Ujian</strong> Terakhir</h3></div>
                <div class="card-body table-responsive">
                    <table class="table table-bordered table-hover datatables">
                        <thead class="bg-dark text-light">
                            <tr>
                                <th>No.</th>
                                <th>Siswa</th>
                                <th>Kelas</th>
                                <th>Nilai</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tabel1 as $t1Key => $t1)
                                <tr>
                                    <td>{{ ++$t1Key }}</td>
                                    <td>{{ $t1['nama'] }}</td>
                                    <td>{{ $t1['nama_kelas'] }}</td>
                                    <td>{{ $t1['nilai'] }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    $('#pindahSiswa').on('click', function(){
        window.location.replace($(this).attr('href'));
    });

    $('#pindahUjian').on('click', function(){
        window.location.replace($(this).attr('href'));
    });

    $('#selengkapnya').on('click', function(){
        window.location.replace($(this).attr('href'));
    });

    var $dataChart = {!! json_encode(array($chart1)) !!};
    var $daftar_kelas = [];var $label;var $daftar_nilai = [];
    $dataChart.forEach(function(realData){
        $daftar_kelas.push(realData.kelas);
        $label = realData.judul;
        $daftar_nilai.push(realData.rataNilai);
    });
    var ctx = document.getElementById('chart1').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'horizontalBar',
        data: {
            labels:$daftar_kelas,
            datasets: [{
                label: 'Rata - Rata Nilai',
                data: $daftar_nilai,
                borderWidth: 1,
                backgroundColor: 'lightblue'
            }]
        }                
    });

</script>
@endsection