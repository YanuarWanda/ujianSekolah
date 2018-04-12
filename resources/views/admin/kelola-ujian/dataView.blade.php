@extends('layouts.app')

@section('css')
<style type="text/css">
.judul-tippy {
    color: #2ecc71;
}
</style>
@stop

@section('content')
    <div class="container-fluid">
        
        @if(Auth::user()->hak_akses == 'guru')
        <a href="{{url('/kelola-ujian/create')}}" class="btn-lg btn-success btn-fixed-bottom"><i class="fa fa-plus" aria-hidden="false"> Tambah Ujian</i></a>
        @endif

        <div class="row">
            <div class="container-fluid pull-left">
            @if(isset($_POST['search_query']))
                <h4>Ujian berjudul <code>{{$_POST['search_query']}}</code></h4>
            @endif
            </div>
            <div class="container-fluid pull-right row">
                <form method="post" action="{{ route('ujian') }}">
                    {{ csrf_field() }}
                <div class="col-md-8 form-group">
                    <input type="text" name="search_query" placeholder="Cari Ujian.." class="form-control">
                </div>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-primary btn-block"><span class="fa fa-search"></span></button>
                </div>
                </form>
            </div>

            @if(count($ujian) > 0)

            @foreach($ujian as $u => $isi)
            <div class="col-sm-12 col-md-12">
                <div class="panel-group" id="accordion">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <span class="panel-title">
                        <a href="#{{$isi->id_ujian}}" data-toggle="collapse" data-parent="accordion">{{$isi->judul_ujian}}</a>
                        </span>
                        <div class="close-btn">
                            <p type="button" href="{{ url('/kelola-ujian/delete', base64_encode($isi->id_ujian)) }}" class="removeUjian bisaHover" style="padding-right:5px;padding-left:5px;padding-top:2px;padding-bottom:2px;margin:0"><i class="fa fa-close fa-1x"></i></p>
                        </div>
                    </div>
                    
                    <div id="{{$isi->id_ujian}}" class="panel-collapse collapse out">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-6">
                                <legend>Rincian</legend>
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <tr>
                                            <td>Waktu Pengerjaan</td>
                                            <td>{{$isi->waktu_pengerjaan}}</td>
                                        </tr>
                                        <tr>
                                            <td>Batas Pengerjaan</td>
                                            <td>{{$isi->tanggal_kadaluarsa}}</td>
                                        </tr>
                                        <tr>
                                            <td>Status</td>
                                            <td>{{$isi->status}}</td>
                                        </tr>
                                        <tr>
                                            <td>Catatan</td>
                                            <td>{{$isi->catatan}}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <legend>Aksi</legend>
                                
                                <div class="container-fluid row">
                                    {{-- Ujian --}}
                                    <div class="col-md-12 row" style="margin-bottom: 7px;">
                                        <div class="col-md-4">
                                            @if($isi->status == 'Draft')
                                            <button type="button" class="btn btn-success btn-block" data-toggle="modal" data-target="#post_{{$u}}" title="<h4 class='judul-tippy'>Post Ujian</h4><h5>Kirimkan ujian kepada siswa</h5>"
                                                data-tippy-placement="left">Post Ujian</button>
                                            @else
                                            <a class="text-center btn btn-danger btn-block" id="unpostModal" href="{{url('/kelola-ujian/DRAFT', base64_encode($isi->id_ujian))}}" 
                                                title="<h4 class='judul-tippy'>Unpost Ujian</h4><h5>Ubah status ujian menjadi selesai</h5>"
                                                data-tippy-placement="left"                                                
                                                >Unpost Ujian</a>
                                            @endif
                                        </div>
                                        <div class="col-md-4">
                                            <a class="text-center btn btn-warning btn-block" href="{{url('/kelola-ujian/edit', base64_encode($isi->id_ujian))}}" title="<h4 class='judul-tippy'>Detail Ujian</h4><h5>Ubah data ujian, tambahkan soal ke dalam ujian</h5>" data-tippy-placement="top">Detail Ujian</a>
                                        </div>
                                        <div class="col-md-4">
                                            <a class="text-center btn btn-primary btn-block" href="{{ url('/daftar-nilai', base64_encode($isi->id_ujian)) }}" title="<h4 class='judul-tippy'>Daftar Nilai</h4><h5>Lihat semua nilai untuk ujian ini</h5>" data-tippy-placement="top">Daftar Nilai</a>
                                        </div>
                                    </div>
                                    {{-- Ujian --}}

                                    {{-- Remed --}}
                                    <div class="col-md-12 row">
                                        @foreach($ujianRemedial as $ur => $isiUR)
                                            @if($isiUR->id_ujian == $isi->id_ujian)
                                                <div class="col-sm-4">
                                                    <button type="button" class="btn btn-success btn-block PostRemedBtn" data-keberapa="{{$u}}" title="<h4 class='judul-tippy'>Post Remedial</h4><h5>Kirimkan soal remedial untuk siswa dengan nilai dibawah KKM</h5>" data-tippy-placement="left">Post Remedial</button>
                                                </div>
                                                <div class="col-sm-4">
                                                    <a class="text-center btn btn-warning btn-block DetailRemedBtn" data-keberapa="{{$u}}" title="<h4 class='judul-tippy'>Detail Remedial</h4><h5>Tampilkan data remedial ini (termasuk soal)</h5>" data-tippy-placement="bottom">Detail Remedial</a>
                                                </div>
                                                <?php break; ?>
                                            @elseif($ur == count($ujianRemedial)-1)
                                                <div class="col-sm-4">
                                                    <a class="text-center btn btn-block btn-disabled" disabled>Post Remedial</a>
                                                </div>
                                                <div class="col-sm-4">
                                                    <a class="text-center btn btn-block btn-disabled" disabled>Detail Remedial</a>
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
                                                        <a class="btn btn-primary btn-block" title="<h4 class='judul-tippy'>Tambah Remedial</h4><h5>Tambahkan soal remedial untuk soal ini</h5>" data-tippy-placement="bottom">Tambah Remedial</a>
                                                    </div>
                                                    
                                                    <?php break; ?>
                                                @elseif($sr == count($sRemed)-1)
                                                    <div class="col-sm-4">
                                                        <a class="btn btn-disabled" disabled>Tambah Remedial</a>
                                                    </div>
                                                @endif
                                            @endforeach
                                        @else
                                           <?php $as=0;$az=0; ?>
                                            <div class="col-sm-4">
                                                <a class="btn btn-disabled" disabled>Tambah Remedial</a>
                                            </div>
                                        @endif
                                    </div>
                                    {{-- Remed --}}


                                    {{-- Button Post Remed --}}
                                    <div class="col-md-12 row menuPostRemed_{{$u}} text-center" style="margin-top: 5px;display: none" aria-expanded="false">
                                        @foreach($ujianRemedial as $ur => $isiUR)
                                            @if($isiUR->id_ujian == $isi->id_ujian)
                                                @if($isiUR->remed_ke == 1 && $isiUR->status == 'Belum Selesai')
                                                    <a class="btn btn-success" data-toggle="modal" data-target="#post_remed_{{$u}}_{{$isiUR->remed_ke}}">Remedial 1</a>
                                                    <?php break; ?>
                                                @elseif($isiUR->remed_ke == 1 && $isiUR->status == 'posted')
                                                    <a class="text-center btn btn-danger" id="unpostModal" href="{{url('/kelola-remed/DRAFT', base64_encode($isiUR->id_ujian_remedial))}}">Remedial 1</a>
                                                    <?php break; ?>
                                                @elseif($ur == count($ujianRemedial)-1)
                                                    <a class="text-center btn btn-disabled" disabled>Post Remedial</a>
                                                @endif
                                            @elseif($ur == count($ujianRemedial)-1)
                                                <a class="text-center btn btn-disabled" disabled>Post Remedial</a>
                                            @endif
                                        @endforeach

                                        @foreach($ujianRemedial as $ur => $isiUR)
                                            @if($isiUR->id_ujian == $isi->id_ujian)
                                                @if($isiUR->remed_ke == 2 && $isiUR->status == 'Belum Selesai')
                                                    <a class="btn btn-success" data-toggle="modal" data-target="#post_remed_{{$u}}_{{$isiUR->remed_ke}}">Remedial 2</a>
                                                    <?php break; ?>
                                                @elseif($isiUR->remed_ke == 2 && $isiUR->status == 'posted')
                                                    <a class="btn btn-danger" id="unpostModal" href="{{url('/kelola-remed/DRAFT', base64_encode($isiUR->id_ujian_remedial))}}">Remedial 2</a>
                                                    <?php break; ?>
                                                @elseif($ur == count($ujianRemedial)-1)
                                                    <a class="btn btn-disabled" disabled>Remedial 2</a>
                                                @endif
                                            @elseif($ur == count($ujianRemedial)-1)
                                                <a class="btn btn-disabled" disabled>Remedial 2</a>
                                            @endif
                                        @endforeach

                                        @foreach($ujianRemedial as $ur => $isiUR)
                                            @if($isiUR->id_ujian == $isi->id_ujian)
                                                @if($isiUR->remed_ke == 3 && $isiUR->status == 'Belum Selesai')
                                                    <a class="btn btn-success" data-toggle="modal" data-target="#post_remed_{{$u}}_{{$isiUR->remed_ke}}">Remedial 3</a>
                                                    <?php break; ?>''
                                                @elseif($isiUR->remed_ke == 3 && $isiUR->status == 'posted')
                                                    <a class="btn btn-danger" id="unpostModal" href="{{url('/kelola-remed/DRAFT', base64_encode($isiUR->id_ujian_remedial))}}">Remedial 3/a>
                                                    <?php break; ?>
                                                @elseif($ur == count($ujianRemedial)-1)
                                                    <a class="btn btn-disabled" disabled>Remedial 3</a>
                                                @endif
                                            @elseif($ur == count($ujianRemedial)-1)
                                                <a class="btn btn-disabled" disabled>Remedial 3</a>
                                            @endif
                                        @endforeach
                                    </div>
                                    {{-- Button Post Remed --}}

                                    {{-- Detail Remed --}}
                                    <div class="col-md-12 row menuDetailRemed_{{$u}} text-center" style="margin-top: 5px;display: none" aria-expanded="false">
                                        @foreach($sRemed as $sr => $isiSR)    
                                            @if($isi->id_ujian == $isiSR->id_ujian)
                                                @if($isiSR->remed_ke == 1)
                                                    <a class="btn btn-warning" href="{{url('/kelola-remed/edit', base64_encode($isiSR->id_ujian_remedial))}}">Remedial 1</a>
                                                    <?php break; ?>
                                                @elseif($sr == count($ar)-1)
                                                    <a class="btn btn-disabled" disabled>Remedial 1</a>
                                                @endif
                                            @endif
                                        @endforeach

                                        @foreach($sRemed as $sr => $isiSR)
                                            @if($isi->id_ujian == $isiSR->id_ujian)
                                                @if($isiSR->remed_ke == 2)
                                                    <a class="btn btn-warning" href="{{url('/kelola-remed/edit', base64_encode($isiSR->id_ujian_remedial))}}">Remedial 2</a>
                                                    <?php break; ?>
                                                @elseif($sr == count($ar)-1)
                                                    <a class="btn btn-disabled" disabled>Remedial 2</a>
                                                @endif
                                            @endif
                                        @endforeach

                                        @foreach($sRemed as $sr => $isiSR)
                                            @if($isi->id_ujian == $isiSR->id_ujian)
                                                @if($isiSR->remed_ke == 3)
                                                    <a class="btn btn-warning" href="{{url('/kelola-remed/edit', base64_encode($isiSR->id_ujian_remedial))}}">Remedial 3</a>
                                                    <?php break; ?>
                                                @elseif($sr == count($ar)-1)
                                                    <a class="btn btn-disabled" disabled>Remedial 3</a>
                                                @endif
                                            @endif
                                        @endforeach
                                    </div>
                                    {{-- Detail Remed --}}

                                    {{-- Add Remed --}}
                                    <div class="col-md-12 row menuAddRemed_{{$u}} text-center" style="margin-top: 5px;display: none" aria-expanded="false">
                                        @if($az == 2)
                                        <a class="btn btn-disabled" disabled>Remedial 1</a>
                                        <a class="btn btn-disabled" disabled>Remedial 2</a>
                                        <a class="btn btn-primary" href="{{url('/kelola-remed/create', base64_encode($isi->id_ujian))}}">Remedial 3</a>
                                        @elseif($az == 1)
                                        <a class="btn btn-disabled" disabled>Remedial 1</a>
                                        <a class="btn btn-primary" href="{{url('/kelola-remed/create', base64_encode($isi->id_ujian))}}">Remedial 2</a>
                                        <a class="btn btn-disabled" disabled>Remedial 3</a>
                                        @else
                                        <a class="btn btn-primary" href="{{url('/kelola-remed/create', base64_encode($isi->id_ujian))}}">Remedial 1</a>
                                        <a class="btn btn-disabled" disabled>Remedial 2</a>
                                        <a class="btn btn-disabled" disabled>Remedial 3</a>
                                    @endif
                                    </div>
                                    {{-- Add Remed --}}
                                </div>

                            </div>
                        </div>
                    </div>
                    </div>

                    <div class="panel-footer">
                        {{-- @if(Auth::user()->hak_akses == 'admin'){!!"Di post oleh <span style='color:red;'>Administrator</span>, ".$isi->tanggal_post!!} --}}
                        {{-- @else  --}}
                        @if($isi->guru['nama'])
                            <p>Dibuat oleh 
                                <a href="{{route('guru.show', base64_encode($isi->guru['id_guru']) )}}">{{$isi->guru['nama']}}</a>,
                                {!! date('d M Y', strtotime($isi->tanggal_pembuatan)) !!}
                            </p>
                        @else
                            {!! "Dibuat oleh <span style='color:red'> Admin </span>, ".$isi->tanggal_pembuatan !!}
                        @endif
                        {{-- @endif --}}
                    </div>
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

            <div class="pull-right">
                {{ $ujian->links() }}
            </div>

            @else
            <hr>
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


        // Tooltip
        tippy('[title]', {
          delay: 99,
          arrow: true,
          arrowType: 'round',
          size: 'large'
        });
    });
</script>
@endsection
