@extends('layouts.app')

@section('content')
@include('layouts/navbar/navbar_siswa')
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
                    <form action="{{ url('siswa/profil') }}" method="POST">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="nis" class="col-form-label">NIS</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="fas fa-id-card"></i></div>
                                        </div>
                                        <input type="text" class="form-control" id="nis" name="nis" value="{{ $siswa->nis }}" autocomplete="off">
                                    </div>
                                </div>
                           </div>
                            <div class="col-lg-6">
                                <div class="form-grou">
                                    <label for="nama">Nama</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="fas fa-id-badge"></i></div>
                                        </div>
                                        <input type="text" class="form-control" id="nama" name="nama" value="{{ $siswa->nama }}" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="fas fa-user-circle fa-fw"></i></div>
                                        </div>
                                        <input type="text" class="form-control" id="username" name="username" placeholder="Masukkan username anda" value="{{ Auth::user()->username }}" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="email">E-Mail</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="fas fa-envelope fa fw"></i></div>
                                        </div>
                                        <input type="email" name="email" id="email" class="form-control" placeholder="contoh:yanuar.wanda2@gmail.com" value="{{ Auth::user()->email }}">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="kelas">Kelas</label>
                            <select name="kelas" id="kelas" class="form-control" autocomplete="off">
                                @foreach($daftarKelas as $k)
                                    <option value="{{ $k->id_kelas }}"
                                        @if($siswa->id_kelas == $k->id_kelas)
                                            selected
                                        @endif
                                    >{{ $k->nama_kelas }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fas fa-home"></i></div>
                                </div>
                                <textarea name="alamat" id="alamat" class="form-control" autocomplete="off">{{ $siswa->alamat }}</textarea>
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
                                        <select name="jenisKelamin" id="jenisKelamin" class="form-control" autocomplete="off">
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
                                        <input type="text" class="form-control" name="tahunAjaran" id="tahunAjaran" value="{{ $siswa->tahun_ajaran }}" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="btn-group btn-block">
                            <button type="submit" class="btn btn-primary btn-membesar" data-toggle="tooltip" data-placement="top" title="Ubah Data"><i class="fas fa-edit"></i></button>
                        </div>
                    </form>
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