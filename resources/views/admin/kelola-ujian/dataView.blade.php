@extends('layouts.app')

@section('content')
    <div class="container">
        <a href="{{url('/kelola-ujian/create')}}" class="btn btn-primary btn-fixed-bottom-right z-top"><i class="fa fa-plus" aria-hidden="false"> Tambah Ujian</i></a>
        <div class="row">
            @if(count($ujian) > 0)
            @foreach($ujian as $u => $isi)
            <div class="col-sm-12 col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        {{$isi->id_ujian.". ".$isi->judul_ujian}}
                        <div class="close-btn">
                            <p type="button" href="{{ url('/kelola-ujian/delete', base64_encode($isi->id_ujian)) }}" class="removeUjian bisaHover" style="padding-right:5px;padding-left:5px;padding-top:2px;padding-bottom:2px;margin:0"><i class="fa fa-close fa-1x"></i></p>
                        </div>
                    </div>
                    <div class="panel-body">
                        (Deskripsi)<br>
                        Waktu Pengerjaan : {{$isi->waktu_pengerjaan}}<br>
                        Batas Pengerjaan : {{$isi->tanggal_kadaluarsa}}<br>
                        Status : {{$isi->status}}<br>
                        Catatan : {{$isi->catatan}}<br>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <a class="text-center btn btn-primary btn-block" href="{{ url('/daftar-nilai', base64_encode($isi->id_ujian)) }}" style="height:120px"><i class="fa fa-book fa-5x"></i><br>Daftar Nilai</a>
                            </div>

                            <div class="col-sm-9">
                                <div class="row">
                                    <div class="col-sm-6">
                                        @if($isi->status == 'Draft')
                                        <button type="button" class="btn btn-info btn-block" data-toggle="modal" data-target="#post_{{$u}}">Post Ujian</button>
                                        @else
                                        <a class="text-center btn btn-info btn-block" id="unpostModal" href="{{url('/kelola-ujian/DRAFT', base64_encode($isi->id_ujian))}}">Unpost Ujian</a>
                                        @endif
                                    </div>
                                    <div class="col-sm-6">
                                        <a class="text-center btn btn-warning btn-block" href="{{url('/kelola-ujian/edit', base64_encode($isi->id_ujian))}}">Detail Ujian</a>
                                    </div>
                                </div>
                                <div class="row" style="margin-top: 48px">
                                    @foreach($ujianRemedial as $ur => $isiUR)
                                        @if($isiUR->id_ujian == $isi->id_ujian)
                                            <div class="col-sm-4">
                                                @if($isiUR->status == 'Belum Selesai')
                                                <button type="button" class="btn btn-info btn-block" data-toggle="modal" data-target="#post_remed_{{$u}}">Post Remed</button>
                                                @else
                                                <a class="text-center btn btn-info btn-block" id="unpostModal" href="{{url('/kelola-remed/DRAFT', base64_encode($isi->id_ujian))}}">Unpost</a>
                                                @endif
                                            </div>
                                            <div class="col-sm-4">
                                                <a class="text-center btn btn-warning btn-block" href="{{url('/kelola-remed/edit', base64_encode($isi->id_ujian))}}">Detail Remed</a>
                                            </div>
                                            <?php break; ?>
                                        @elseif($ur == count($ujianRemedial)-1)
                                            <div class="col-sm-4">
                                                <a class="text-center btn btn-disabled">Post Remed</a>
                                            </div>
                                            <div class="col-sm-4">
                                                <a class="text-center btn btn-disabled">Detail Remed</a>
                                            </div>
                                        @endif
                                    @endforeach

                                    @if($sRemed)
                                        @foreach($sRemed as $sr => $isiSR)
                                            @if($isi->id_ujian == $isiSR->id_ujian && date('Y-m-d') > $isi->tanggal_kadaluarsa)
                                                <div class="col-sm-4">
                                                    <a class="btn btn-primary btn-block" href="{{url('/kelola-remed/create', base64_encode($isi->id_ujian))}}">Add Remed</a>
                                                </div>
                                                <?php break; ?>
                                            @elseif($sr == count($sRemed)-1)
                                                <div class="col-sm-4">
                                                    <a class="btn btn-disabled" disabled>Add Remed</a>
                                                </div>
                                            @endif
                                        @endforeach
                                    @else
                                        <div class="col-sm-4">
                                            <a class="btn btn-disabled" disabled>Add Remed</a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel-footer">
                        {{-- @if(Auth::user()->hak_akses == 'admin'){!!"Di post oleh <span style='color:red;'>Administrator</span>, ".$isi->tanggal_post!!} --}}
                        {{-- @else  --}}
                        @if($isi->guru['nama'])
                            {{"Di post oleh ".$isi->guru['nama'].", ".$isi->tanggal_post}}
                        @else
                            {!! "Di post oleh <span style='color:red'> Admin </span>, ".$isi->tanggal_post !!}
                        @endif
                        {{-- @endif --}}
                    </div>
                </div>
            </div>

            <!-- Modal -->
            <div id="post_{{$u}}" class="modal fade" role="dialog">
              <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <form id="post-data_{{$u}}" method="POST" action="{{url('/kelola-ujian/POST', base64_encode($isi->id_ujian))}}">
                    {{ csrf_field() }}
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Pilih Kelas</h4>
                      </div>
                      <div class="modal-body">
                        <p>Silahkan pilih kelas-kelas yang akan diberikan soal</p>
                        <select name="kelas[]" id="kelas_{{$u}}" class="form-control selectpicker show-menu-arrow" data-live-search="true" multiple data-selected-text-format="count" data-size="5" multiple>
                            @foreach($kelas as $k)
                                <option>
                                    {{ $k->nama_kelas }}
                                </option>
                            @endforeach
                        </select>

                        <hr>

                        <p>Silahkan tentukan kapan post kadaluarsa</p>
                        <input type="date" name="tanggalKadaluarsa" class="form-control">

                      </div>
                      <div class="modal-footer">
                        <button onclick="submit();" class="btn btn-primary" data-dismiss="modal">Post</button>
                      </div>
                    </form>
                </div>

              </div>
            </div>
            <!-- Modal -->

            <div id="post_remed_{{$u}}" class="modal fade" role="dialog">
                <div class="modal-dialog">
                <!-- Modal Remed content-->
                    <div class="modal-content">
                        <form id="post-remed_{{$u}}" action="{{ url('/kelola-remed/POST', base64_encode($isi->id_ujian)) }}" method="POST">
                            {{ csrf_field() }}
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4>Post Ujian Remed</h4>
                            </div>
                            <div class="modal-body">
                                <p>Silakan tentukan kapan post kadaluarsa</p>
                                <input type="date" name="tanggalKadaluarsaRemed" class="form-control">
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Post</button>
                            </div>
                        </form>
                    </div>
                <!-- Modal Remed -->
                </div>
            </div>
            @endforeach
            @else
            <p>Data not available.</p>
            @endif
        </div>
    </div>
@endsection

@section('js')
<script type="text/javascript">
    function form_submit() {
        document.getElementById("post-data").submit();
    }
</script>
@endsection
