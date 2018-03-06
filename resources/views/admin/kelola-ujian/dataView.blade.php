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
                            <button type="button" href="{{ url('/kelola-ujian/delete', base64_encode($isi->id_ujian)) }}" class="btn btn-danger removeUjian" style="padding-right:5px;padding-left:5px;padding-top:2px;padding-bottom:2px;margin:0"><i class="fa fa-close fa-1x"></i></button>
                        </div>
                    </div>
                    <div class="panel-body">
                        (Deskripsi)<br>
                        Waktu Pengerjaan : {{$isi->waktu_pengerjaan}}<br>
                        {{-- Batas Pengerjaan : {{$isi->tanggal_kadaluarsa}}<br> --}}
                        Status : {{$isi->status}}<br>
                        Catatan : {{$isi->catatan}}<br>
                        <hr>
                        <div class="row">
                            <div class="col-sm-4">
                                <a class="text-center btn btn-primary btn-block" href="{{ url('/daftar-nilai', base64_encode($isi->id_ujian)) }}">Daftar Nilai</a>
                            </div>
                            <div class="col-sm-4">
                                @if($isi->status == 'Draft')
                                <button type="button" class="btn btn-info btn-block" data-toggle="modal" data-target="#post_{{$u}}">Post Ujian</button>
                                @else
                                <a class="text-center btn btn-info btn-block" id="unpostModal" href="{{url('/kelola-ujian/DRAFT', base64_encode($isi->id_ujian))}}">Unpost Ujian</a>
                                @endif
                            </div>
                            <div class="col-sm-4">
                                <a class="text-center btn btn-warning btn-block" href="{{url('/kelola-ujian/edit', base64_encode($isi->id_ujian))}}">Detail Ujian</a>
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
                      </div>
                      <div class="modal-footer">
                        <button onclick="submit();" class="btn btn-primary" data-dismiss="modal">Post</button>
                      </div>
                    </form>
                </div>

              </div>
            </div>
            <!-- Modal -->
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
