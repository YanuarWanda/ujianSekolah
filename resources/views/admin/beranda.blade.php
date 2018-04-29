@extends('layouts/app')

@section('content')
@include('layouts/navbar/navbar_admin')
            <!-- <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">Beranda</li>
                </ol>
            </nav> -->
            <div class="content p-4">
                <h1>Selamat Datang di U-Lah!</h1>
                <hr>
                <div class="row">    
                    <div class="col-lg-6">
                        <div class="card h-100">
                            <div class="card-header text-center"><h3>Grafik Jumlah <strong>Guru</strong> per Bidang Keahlian</h3></div>
                            <div class="card-body">
                                <canvas id="chart1"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card h-100">
                            <div class="card-header text-center"><h3>Tabel Jumlah <strong>Guru</strong> per Bidang Keahlian</h3></div>
                            <div class="card-body table-responsive">
                                <table class="table table-bordered table-hover datatables">
                                    <thead class="bg-dark text-light">
                                        <tr>
                                            <th>No.</th>
                                            <th>Bidang Keahlian</th>
                                            <th>Jumlah</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($chart1 as $dc1Key => $dc1)
                                            <tr>
                                                <td>{{ ++$dc1Key }}</td>
                                                <td>{{ $dc1->bidang_keahlian }}</td>
                                                <td>{{ $dc1->jumlah }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
@include('layouts/navbar/navbar_admin_footer')
<script type="text/javascript">
    $(window).on('load', function(){
        $('#sidebar-menu-beranda').addClass('active');
    });    

    var $dataChart1 = {!! json_encode($chart1) !!};
    var $daftarBidang = [];var $daftarJumlah = [];
    $dataChart1.forEach(function(realData){
        $daftarBidang.push(realData.bidang_keahlian);
        $daftarJumlah.push(realData.jumlah);
    });
    var ctx = document.getElementById('chart1').getContext('2d');
    var myChart1 = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: $daftarBidang,
            datasets: [{
                label: 'Jumlah Guru',
                data: $daftarJumlah,
                borderWidth: 1,
                backgroundColor: ['red', 'yellow', 'green', 'blue', 'lightblue', 'orange', 'grey']
            }]
        }
    });

</script>
@endsection