@extends('layouts.app')

@section('css')
<style>

</style>
@endsection

@section('content')
@include('layouts/navbar/navbar_guru')
<div class="container text-dark mt-2 mb-2">
    <div class="row">
        <div class="col-lg-3">
            <div class="card">
                <div class="card-header text-center">{{ $siswa->nama }}</div>
                <div class="card-body">
                    <img @if($siswa->foto != 'nophoto.jpg') src="{{ asset('storage/foto-profil/'.$siswa->foto) }}" @else src="{{ asset('image/nophoto.jpg') }}" @endif alt="{{ $siswa->nama }}" class="img-thumbnail">
                </div>
            </div>
        </div>
        <div class="col-lg-9">
            <div class="card">
                <div class="card-header text-center">Detail Data Siswa</div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="nis" class="col-form-label">NIS</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="fas fa-id-badge"></i></div>
                            </div>
                            <input type="text" class="form-control" id="nis" value="{{ $siswa->nis }}" readonly="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="kelas">Kelas</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="fas fa-university"></i></div>
                            </div>
                            <input type="text" class="form-control" id="kelas" value="{{ $siswa->nama_kelas }}" readonly="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="fas fa-home"></i></div>
                            </div>
                            <textarea name="alamat" id="alamat" class="form-control" readonly="">{{ $siswa->alamat }}</textarea>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="jenisKelamin">Jenis Kelamin</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fas fa-male"></i></div>
                                    </div>
                                    <select name="jenisKelamin" id="jenisKelamin" class="form-control" disabled="">
                                        <option value="L" @if($siswa->jenis_kelamin == 'L') selected @endif>Laki-Laki</option>
                                        <option value="P" @if($siswa->jenis_kelamin == 'P') selected @endif>Perempuan</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="tahunAjaran">Tahun Ajaran</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fas fa-calendar"></i></div>
                                    </div>
                                    <input type="text" class="form-control" id="tahunAjaran" value="{{ $siswa->tahun_ajaran }}" readonly="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item">
            <a href="#grafik" class="nav-link" id="grafik-tab" data-toggle="tab" role="tab" aria-controls="grafik" aria-selected="true">Grafik</a>
        </li>    
        <li class="nav-item">
            <a href="#tabel" class="nav-link active" id="tabel-tab" data-toggle="tab" role="tab" aria-controls="tabel" aria-selected="false">Daftar Nilai</a>
        </li>
    </ul>
    
    <div class="tab-content">
        <div class="tab-pane" id="grafik" role="tabpanel" aria-labelledby="grafik-tab">
            <div class="card">
                <div class="card-body">
                    <canvas id="grafikAbility"></canvas>
                </div>
            </div>
        </div>
        <div class="tab-pane active" id="tabel" role="tabpanel" aria-labelledby="tabel-tab">
            <div class="card">
                <div class="card-body">
                    <table class="table table-bordered table-hover datatables">
                        <thead class="bg-dark text-light">
                            <tr>
                                <th>No.</th>
                                <th>Mapel</th>
                                <th>Ujian</th>
                                <th>Nilai</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($daftarNilai as $number => $n)
                                <tr>
                                    <td>{{ $number+1 }}</td>
                                    <td>{{ $n->nama_mapel }}</td>
                                    <td>{{ $n->judul_ujian }}</td>
                                    <td>{{ $n->nilai }}</td>
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
    var $skill = {!! $ability !!};
    var $mapel = [];var $nilai =[];
    $skill.forEach(function(realData){
        $mapel.push(realData.mapel);
        $nilai.push(realData.nilai);
    });

    console.log($mapel);
    console.log($nilai);

    var dataBuatChart = {
        labels: $mapel,
        datasets: [{
            label: 'Rata - Rata Nilai',
            backgroundColor: 'rgba(128, 128, 128, 0.5)',
            data: $nilai
        }]  
    };
    var dataCanvasnya = document.getElementById('grafikAbility').getContext('2d');

    var chartnya = new Chart(dataCanvasnya, {
        type: 'radar',
        data: dataBuatChart
    });
</script>
@endsection