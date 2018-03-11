@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">Form Edit Ujian | {{ $ujian->judul_ujian }}</div>
                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" action="{{url('/kelola-ujian/update', base64_encode($ujian->id_ujian))}}">
                            {{csrf_field()}}

                            <div class="form-group{{ $errors->has('mapel') ? ' has-error' : '' }}">
                                <label for="mapel" class="col-md-4 control-label">Mata Pelajaran</label>

                                <div class="col-md-6">
                                    <select name="mapel" id="mapel" class="form-control">
                                        @foreach($mapel as $m)
                                            <option value="{{ $m->id_mapel }}" @if($m->id_mapel == $ujian->id_mapel || old('mapel') == $m->nama_mapel) {{ 'selected' }} @endif>{{ $m->nama_mapel }}</option>
                                        @endforeach
                                    </select>

                                    @if ($errors->has('mapel'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('mapel') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('judul') ? ' has-error' : '' }}">
                                <label for="judul" class="col-md-4 control-label">Judul Ujian</label>

                                <div class="col-md-6">
                                    <input id="judul" type="text" class="form-control" name="judul" value="{{ $ujian->judul_ujian }}" required>

                                    @if ($errors->has('judul'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('judul') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('kkm') ? ' has-error' : '' }}">
                                <label for="kkm" class="col-md-4 control-label">Nilai KKM</label>

                                <div class="col-md-6">
                                    <input id="kkm" class="form-control" type="number" name="kkm" value="{{ $ujian->kkm }}" required/>

                                    @if($errors->has('kkm'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('kkm') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('waktu_pengerjaan') ? ' has-error' : '' }}">
                                <label for="waktu_pengerjaan" class="col-md-4 control-label">Waktu Pengerjaan</label>

                                <div class="col-md-6">
                                    <input id="waktu_pengerjaan" type="text" class="form-control timing" name="waktu_pengerjaan" value="{{ $wp }}" required>

                                    @if ($errors->has('waktu_pengerjaan'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('waktu_pengerjaan')}}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            {{-- <div class="form-group{{ $errors->has('batas_pengerjaan') ? ' has-error' : '' }}">
                                <label for="batas_pengerjaan" class="col-md-4 control-label">Batas Pengerjaan</label>

                                <div class="col-md-6">
                                    <div class="input-group date" id="datetimepicker1">
                                        <input id="batas_pengerjaan" type="text" class="form-control" name="batas_pengerjaan" value="{{ $ujian->tanggal_kadaluarsa }}" required/>
                                        <span class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </span>
                                    </div>

                                    @if ($errors->has('batas_pengerjaan'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('batas_pengerjaan')}}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div> --}}

                            <div class="form-group{{ $errors->has('catatan') ? ' has-error' : '' }}">
                                <label for="catatan" class="col-md-4 control-label">Catatan</label>

                                <div class="col-md-6">
                                    <textarea id="catatan" class="form-control" name="catatan" >{{ $ujian->catatan }}</textarea>

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
                                    <button type="submit" class="btn btn-primary pull-right">
                                        <i class="fa fa-edit fa-1x"></i> Update Ujian
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
                        @if(count($soal) > 0)
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
                                    @foreach($soal as $s => $isiSoal)
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
                                                <a href="{{url('/kelola-soal/edit', base64_encode($isiSoal['id_soal']))}}" class="btn btn-primary"><i class="fa fa-edit" aria-hidden="true"></i></a>
                                                <a href="{{url('/kelola-soal/delete', base64_encode($isiSoal['id_soal']))}}" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                            </tbody>
                        </table>

                        @else
                            <strong><p>Data tidak tersedia.</p></strong>
                        @endif
                        <a class="btn btn-primary btn-block" id="tambahSoal" style="border-radius:0px">
                            <i class="fa fa-plus fa-1x"></i> 
                            Tambah Soal
                        </a>
                        <div class="row menuSoal" style="margin-left: 0%;margin-right: 0%">
                            <div class="col-sm-6 text-center" style="background-color:lightgray">
                                <a href="{{ Route('tambah-soal-bank', $ujian->id_ujian) }}">Import Dari Bank Soal</a>
                            </div>
                            <div class="col-sm-6 text-center" style="background-color:lightblue">
                                <a href="{{url('/kelola-soal/create', base64_encode($ujian->id_ujian))}}">Tambah Soal Sendiri</a>
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
    <script type="text/javascript">
        $(document).ready(function(){
           $('#tambahSoal').on('click', function(){
               $('.menuSoal').slideToggle(500);
           });
        });
    </script>
@endsection
