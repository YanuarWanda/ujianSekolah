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
                                <div class="row" style="margin-top: 5px">
                                    @foreach($ujianRemedial as $ur => $isiUR)
                                        @if($isiUR->id_ujian == $isi->id_ujian)
                                            <div class="col-sm-4">
                                                <button type="button" class="btn btn-info btn-block PostRemedBtn" data-keberapa="{{$u}}">Post Remed</button>
                                            </div>
                                            <div class="col-sm-4">
                                                <a class="text-center btn btn-warning btn-block DetailRemedBtn" data-keberapa="{{$u}}">Detail Remed</a>
                                            </div>
                                            <?php break; ?>
                                        @elseif($ur == count($ujianRemedial)-1)
                                            <div class="col-sm-4">
                                                <a class="text-center btn btn-disabled" disabled>Post Remed</a>
                                            </div>
                                            <div class="col-sm-4">
                                                <a class="text-center btn btn-disabled" disabled>Detail Remed</a>
                                            </div>
                                        @endif
                                    @endforeach

                                    @if($sRemed)
                                        <?php $as=0;$az=0; ?>
                                        @foreach($sRemed as $sr => $isiSR)
                                            @if($isi->id_ujian == $isiSR->id_ujian)
                                                <?php 
                                                    $as++; 
                                                    $az = $isiSR->remed_ke;
                                                    $ar[] = array($sr => array('id_ujian' => $isiSR->id_ujian, 'remed_ke' => $isiSR->remed_ke, 'isi' => $isiSR));
                                                ?>
                                            @endif
                                        @endforeach

                                        @foreach($sRemed as $sr => $isiSR)
                                            @if(date('Y-m-d') > $isi->tanggal_kadaluarsa && $as < 3)
                                                <div class="col-sm-4 AddRemedBtn" data-keberapa="{{$u}}">
                                                    <a class="btn btn-primary btn-block">Add Remed</a>
                                                </div>
                                                
                                                <?php break; ?>
                                            @elseif($sr == count($sRemed)-1)
                                                <div class="col-sm-4">
                                                    <a class="btn btn-disabled" disabled>Add Remed</a>
                                                </div>
                                            @endif
                                        @endforeach
                                    @else
                                       <?php $as=0;$az=0; ?>
                                        <div class="col-sm-4">
                                            <a class="btn btn-disabled" disabled>Add Remed</a>
                                        </div>
                                    @endif
                                </div>

                                <div class="row menuPostRemed_{{$u}} text-center" style="margin-top: 5px;display: none" aria-expanded="false">
                                    @foreach($ujianRemedial as $ur => $isiUR)
                                        @if($isiUR->id_ujian == $isi->id_ujian)
                                            @if($isiUR->remed_ke == 1 && $isiUR->status == 'Belum Selesai')
                                                <a class="btn btn-info" data-toggle="modal" data-target="#post_remed_{{$u}}_{{$isiUR->remed_ke}}">Remed 1</a>
                                                <?php break; ?>
                                            @elseif($isiUR->remed_ke == 1 && $isiUR->status == 'posted')
                                                <a class="text-center btn btn-danger" id="unpostModal" href="{{url('/kelola-remed/DRAFT', base64_encode($isiUR->id_ujian_remedial))}}">Remed 1</a>
                                                <?php break; ?>
                                            @elseif($ur == count($ujianRemedial)-1)
                                                <a class="text-center btn btn-disabled" disabled>Post Remed</a>
                                            @endif
                                        @elseif($ur == count($ujianRemedial)-1)
                                            <a class="text-center btn btn-disabled" disabled>Post Remed</a>
                                        @endif
                                    @endforeach

                                    @foreach($ujianRemedial as $ur => $isiUR)
                                        @if($isiUR->id_ujian == $isi->id_ujian)
                                            @if($isiUR->remed_ke == 2 && $isiUR->status == 'Belum Selesai')
                                                <a class="btn btn-info" data-toggle="modal" data-target="#post_remed_{{$u}}_{{$isiUR->remed_ke}}">Remed 2</a>
                                                <?php break; ?>
                                            @elseif($isiUR->remed_ke == 2 && $isiUR->status == 'posted')
                                                <a class="btn btn-danger" id="unpostModal" href="{{url('/kelola-remed/DRAFT', base64_encode($isiUR->id_ujian_remedial))}}">Remed 2</a>
                                                <?php break; ?>
                                            @elseif($ur == count($ujianRemedial)-1)
                                                <a class="btn btn-disabled" disabled>Remed 2</a>
                                            @endif
                                        @elseif($ur == count($ujianRemedial)-1)
                                            <a class="btn btn-disabled" disabled>Remed 2</a>
                                        @endif
                                    @endforeach

                                    @foreach($ujianRemedial as $ur => $isiUR)
                                        @if($isiUR->id_ujian == $isi->id_ujian)
                                            @if($isiUR->remed_ke == 3 && $isiUR->status == 'Belum Selesai')
                                                <a class="btn btn-info" data-toggle="modal" data-target="#post_remed_{{$u}}_{{$isiUR->remed_ke}}">Remed 3</a>
                                                <?php break; ?>''
                                            @elseif($isiUR->remed_ke == 3 && $isiUR->status == 'posted')
                                                <a class="btn btn-danger" id="unpostModal" href="{{url('/kelola-remed/DRAFT', base64_encode($isiUR->id_ujian_remedial))}}">Remed 3/a>
                                                <?php break; ?>
                                            @elseif($ur == count($ujianRemedial)-1)
                                                <a class="btn btn-disabled" disabled>Remed 3</a>
                                            @endif
                                        @elseif($ur == count($ujianRemedial)-1)
                                            <a class="btn btn-disabled" disabled>Remed 3</a>
                                        @endif
                                    @endforeach
                                </div>

                                <div class="row menuAddRemed_{{$u}} text-center" style="margin-top: 5px;display: none" aria-expanded="false">

                                    @if($az == 2)
                                    <a class="btn btn-disabled" disabled>Remed 1</a>
                                    <a class="btn btn-disabled" disabled>Remed 2</a>
                                    <a class="btn btn-primary" href="{{url('/kelola-remed/create', base64_encode($isi->id_ujian))}}">Remed 3</a>
                                    @elseif($az == 1)
                                    <a class="btn btn-disabled" disabled>Remed 1</a>
                                    <a class="btn btn-primary" href="{{url('/kelola-remed/create', base64_encode($isi->id_ujian))}}">Remed 2</a>
                                    <a class="btn btn-disabled" disabled>Remed 3</a>
                                    @else
                                    <a class="btn btn-primary" href="{{url('/kelola-remed/create', base64_encode($isi->id_ujian))}}">Remed 1</a>
                                    <a class="btn btn-disabled" disabled>Remed 2</a>
                                    <a class="btn btn-disabled" disabled>Remed 3</a>
                                    @endif

                                </div>

                                <div class="row menuDetailRemed_{{$u}} text-center" style="margin-top: 5px;display: none" aria-expanded="false">
                                    @foreach($sRemed as $sr => $isiSR)    
                                        @if($isi->id_ujian == $isiSR->id_ujian)
                                            @if($isiSR->remed_ke == 1)
                                                <a class="btn btn-warning" href="{{url('/kelola-remed/edit', base64_encode($isiSR->id_ujian_remedial))}}">Remed 1</a>
                                                <?php break; ?>
                                            @elseif($sr == count($ar)-1)
                                                <a class="btn btn-disabled" disabled>Remed 1</a>
                                            @endif
                                        @endif
                                    @endforeach

                                    @foreach($sRemed as $sr => $isiSR)
                                        @if($isi->id_ujian == $isiSR->id_ujian)
                                            @if($isiSR->remed_ke == 2)
                                                <a class="btn btn-warning" href="{{url('/kelola-remed/edit', base64_encode($isiSR->id_ujian_remedial))}}">Remed 2</a>
                                                <?php break; ?>
                                            @elseif($sr == count($ar)-1)
                                                <a class="btn btn-disabled" disabled>Remed 2</a>
                                            @endif
                                        @endif
                                    @endforeach

                                    @foreach($sRemed as $sr => $isiSR)
                                        @if($isi->id_ujian == $isiSR->id_ujian)
                                            @if($isiSR->remed_ke == 3)
                                                <a class="btn btn-warning" href="{{url('/kelola-remed/edit', base64_encode($isiSR->id_ujian_remedial))}}">Remed 3</a>
                                                <?php break; ?>
                                            @elseif($sr == count($ar)-1)
                                                <a class="btn btn-disabled" disabled>Remed 3</a>
                                            @endif
                                        @endif
                                    @endforeach
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
            @foreach($sRemed as $sR => $isiSR)
                @if($isi->id_ujian == $isiSR->id_ujian)
                <div id="post_remed_{{$u}}_{{$isiSR->remed_ke}}" class="modal fade" role="dialog">
                    <div class="modal-dialog">
                    <!-- Modal Remed content-->
                        <div class="modal-content">
                            <form id="post-remed_{{$u}}" action="{{ url('/kelola-remed/POST', base64_encode($isiSR->id_ujian_remedial)) }}" method="POST">
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
                @endif
            @endforeach

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

    $(document).ready(function(){
        $('.AddRemedBtn').on('click', function(){
            var $dataKe = $(this).attr('data-keberapa');
            
            if($('.menuDetailRemed_'+$dataKe).attr('aria-expanded') == 'true'){
                $('.menuDetailRemed_'+$dataKe).slideUp(500, function(){
                    $(this).attr('aria-expanded', 'false');
                });
            }
            if($('.menuPostRemed_'+$dataKe).attr('aria-expanded') == 'true'){
                $('.menuPostRemed_'+$dataKe).slideUp(500, function(){
                    $(this).attr('aria-expanded', 'false');
                });
            }

            if($('.menuAddRemed_'+$dataKe).attr('aria-expanded') == 'false'){
                $('.menuAddRemed_'+$dataKe).slideDown(500, function(){
                    $(this).attr('aria-expanded', 'true');
                });
            }else{
                $('.menuAddRemed_'+$dataKe).slideUp(500, function(){
                    $(this).attr('aria-expanded', 'false');
                });
            }
        });

        $('.DetailRemedBtn').on('click', function(){
            var $dataKe = $(this).attr('data-keberapa');

            if($('.menuAddRemed_'+$dataKe).attr('aria-expanded') == 'true'){
                $('.menuAddRemed_'+$dataKe).slideUp(500, function(){
                    $(this).attr('aria-expanded', 'false');
                });
            }
            if($('.menuPostRemed_'+$dataKe).attr('aria-expanded') == 'true'){
                $('.menuPostRemed_'+$dataKe).slideUp(500, function(){
                    $(this).attr('aria-expanded', 'false');
                });
            }

            if($('.menuDetailRemed_'+$dataKe).attr('aria-expanded') == 'false'){
                $('.menuDetailRemed_'+$dataKe).slideDown(500, function(){
                    $(this).attr('aria-expanded', 'true');
                });
            }else{
                $('.menuDetailRemed_'+$dataKe).slideUp(500, function(){
                    $(this).attr('aria-expanded', 'false');
                });
            }
        });

        $('.PostRemedBtn').on('click', function(){
            var $dataKe = $(this).attr('data-keberapa');

            if($('.menuAddRemed_'+$dataKe).attr('aria-expanded') == 'true'){
                $('.menuAddRemed_'+$dataKe).slideUp(500, function(){
                    $(this).attr('aria-expanded', 'false');
                });
            }
            if($('.menuDetailRemed_'+$dataKe).attr('aria-expanded') == 'true'){
                $('.menuDetailRemed_'+$dataKe).slideUp(500, function(){
                    $(this).attr('aria-expanded', 'false');
                });
            }
            
            if($('.menuPostRemed_'+$dataKe).attr('aria-expanded') == 'false'){
                $('.menuPostRemed_'+$dataKe).slideDown(500, function(){
                    $(this).attr('aria-expanded', 'true');
                });
            }else{
                $('.menuPostRemed_'+$dataKe).slideUp(500, function(){
                    $(this).attr('aria-expanded', 'false');
                });
            }

        });
    });
</script>
@endsection
