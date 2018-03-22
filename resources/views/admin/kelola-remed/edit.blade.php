@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">Form Tambah Remed</div>
                    <div class="panel-body">
                        <form class="form-horizontal" action="{{ url('/kelola-remed/update', base64_encode($ujianRemedial->id_ujian_remedial)) }}" id="bgst" method="POST">
                            {{csrf_field()}}

                            <div class="form-group">
                                <label for="ujian" class="col-md-4 control-label">Judul Ujian</label>

                                <div class="col-md-6">
                                    <input type="text" name="ujian" class="form-control" value="{{ $ujian->judul_ujian }}" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="mapel" class="col-md-4 control-label">Mata Pelajaran</label>

                                <div class="col-md-6">
                                    <select class="form-control" name="mapel" readonly>
                                        <option value="{{ $ujian->mapel->nama_mapel }}">{{ $ujian->mapel->nama_mapel }}</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="kkm" class="col-md-4 control-label">Nilai KKM</label>

                                <div class="col-md-6">
                                    <input type="number" name="kkm" class="form-control" value="{{ $ujian->kkm }}" readonly>
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('waktu_pengerjaan') ? ' has-error' : '' }}">
                                <label for="waktu_pengerjaan" class="col-md-4 control-label">Waktu Pengerjaan</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control timing" name="waktu_pengerjaan" value="{{ $wp }}" required>

                                    @if ($errors->has('waktu_pengerjaan'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('waktu_pengerjaan')}}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('catatan') ? ' has-error' : '' }}">
                                <label for="catatan" class="col-md-4 control-label">Catatan</label>

                                <div class="col-md-6">
                                    <textarea id="catatan" class="form-control" name="catatan" >{{ $ujianRemedial->catatan }}</textarea>

                                    @if ($errors->has('catatan'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('catatan') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <a href="/kelola-ujian" class="btn btn-danger">Cancel</a>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-edit fa-1x">Ubah</i>
                                    </button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        Daftar Soal |  {{ $ujian->judul_ujian }}
                    </div>
                    <div class="panel-body">
                        <h1 class="text-center">Daftar Soal</h1>
                        @if(count($soalRemed) > 0)
                        <table class="table table-bordered" id="tableSoal">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Soal</th>
                                    <th>Jawaban</th>
                                    <th>Tipe</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php $no=1; ?>
                                    @foreach($soalRemed as $s => $isiSoal)
                                        <tr>
                                            <td><?php echo $no;$no++; ?></td>
                                            <td>{{ $isiSoal->bankSoal['isi_soal'] }}</td>
                                            @if( $jawabanAsli )
                                                <td>{{ $isiSoal->bankSoal['jawaban'] }}
                                            @else
                                                <td>{{ $jawabanAsli[$s] }}</td>
                                            @endif
                                            <td>{{ $isiSoal->bankSoal['tipe']}}</td>
                                            <td>
                                                <a href="{{url('/kelola-soal-remed/edit', base64_encode($isiSoal['id_soal_remedial']))}}" class="btn btn-primary"><i class="fa fa-edit" aria-hidden="true"></i></a>
                                                <a href="{{url('/kelola-soal-remed/delete', base64_encode($isiSoal['id_soal_remedial']))}}" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                            </tbody>
                        </table>

                        @else
                            <strong><p>Data tidak tersedia.</p></strong>
                        @endif
                        <a class="btn btn-primary btn-block" id="tambahSoal" style="border-radius:0px"><i class="fa fa-plus fa-1x"></i> Tambah Soal</a>
                        <div class="row menuSoal collapse" style="margin-left: 0%;margin-right: 0%">
                            <div class="col-sm-6 text-center" style="background-color:lightgray">
                                <a href="{{ Route('tambah-soal-bank-remed', $ujianRemedial->id_ujian_remedial) }}">Import Dari Bank Soal</a>
                            </div>
                            <div class="col-sm-6 text-center" style="background-color:lightblue">
                                <a href="{{url('/kelola-soal-remed/create', base64_encode($ujianRemedial->id_ujian_remedial))}}">Tambah Soal Sendiri</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script type="text/javascript">
        $(document).ready(function(){
           $('#tambahSoal').on('click', function(){
               $('.menuSoal').slideToggle(500);
           });
        });
    </script>
@endsection
