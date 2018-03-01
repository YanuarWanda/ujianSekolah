@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Data Nilai</div>

                    <div class="panel-body">
                        <div class="table-responsive">
                            @if(count($nilai) > 0)
                                <?php $no=1; ?>
                                @foreach($jumlahNilai as $n => $isiJumlah)
                                    <div class="block" data-panel="Kelas_{{$n}}">
                                        <button type="button" class="btn btn-primary btn-block" style="border-radius:0">{{ $isiJumlah['nama_kelas'] }}</button>
                                    </div>

                                    <div class="blockKelas" id="Kelas_{{$n}}">
                                        <table class="table table-bordered" id="tableNilai">
                                            <?php $index=0; ?>
                                                <thead>
                                                    <tr>
                                                        <th>No.</th>
                                                        <th>Nama</th>
                                                        <th>Jumlah Benar</th>
                                                        <th>Jumlah Salah</th>
                                                        <th>Nilai</th>
                                                    </tr>
                                                </thead>
                                            @foreach($nilai as $ni => $isiN)
                                                @if($isiN['id_kelas'] == $isiJumlah['id_kelas'])
                                                    <tbody>
                                                        <tr>
                                                            <td><?php echo $no;$no++; ?></td>
                                                            <td>{{$isiN->nama}}</td>
                                                            <td>{{$isiJumlah['jawaban_benar']}}</td>
                                                            <td>{{$isiJumlah['jawaban_salah']}}</td>
                                                            <td>{{$isiJumlah['nilai']}}</td>
                                                        </tr>
                                                    </tbody>
                                                @endif
                                                <?php if($index < count($jumlahNilai)-1){ $index++;} ?>
                                            @endforeach
                                        </table>
                                    </div>
                                @endforeach
                            @else
                                <strong><p>Data tidak tersedia.</p></strong>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
