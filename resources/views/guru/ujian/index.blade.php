@extends('layouts/app')

@section('css')
<style>
    .close-btn{
        color: red;
        position: absolute;
        top: 10px;
        right: 30px;
        transition: 0.5s;
    }
    .close-btn:hover{
        color: rgba(255, 0, 0, 0.5);
        transition: 0.5s;
    }
    .bisaHover{
        cursor: pointer;
    }
    .btn-float-add-ujian{
        position:fixed;
        bottom: 10px;
        left: 10px;
    }
    .title{
        font-size: 20px;
    }
</style>
@endsection

@section('content')
@include('layouts/navbar/navbar_guru')
    <div class="container text-dark pt-2">
        <h1 class="text-center">Daftar Ujian</h1>
        
        <div class="row">
            @foreach($ujian as $us => $u)
                <div class="col-lg-6">
                    <div class="card card-ujian">
                        <div class="card-header text-center">
                            <a href="{{ url('guru/ujian/edit', base64_encode($u->id_ujian)) }}" data-toggle="tooltip" data-placement="top" title="Detail Ujian" class="title">{{ $u->judul_ujian }}</a> <br> <b><i>{{ $u->mapel->nama_mapel }}</i></b>
                            <div class="close-btn bisaHover">
                                <span href="{{ url('guru/ujian/delete', base64_encode($u->id_ujian)) }}" class="bisaHover deleteButton"><i class="fas fa-times fa-1x text-danger btn"></i></span>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row pb-0">
                                <div class="col-md-3 kkm">
                                    <h4>KKM : {{ $u->kkm }}</h4>
                                </div>
                                <div class="col-md-9 wp">
                                    <h4>Waktu : {{ $u->waktu_pengerjaan }}</h4>
                                </div>
                            </div>
                            <hr>
                            <h4>Catatan</h4>
                            <p>{{ $u->catatan }}</p>
                            <hr>
                            @if($u->status == 'posted')
                                <h4><span class="btn btn-success unpostModal" href="{{ url('guru/ujian/draft', base64_encode($u->id_ujian)) }}">Posted</span> | <small>sampai {{ $u->tanggal_kadaluarsa }}</small></h4>
                            @else
                                <h4><span class="btn btn-info" data-toggle="modal" data-target="#post_{{$us}}">Draft</span></h4>
                            @endif
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <a href="{{ url('guru/ujian/nilai', base64_encode($u->id_ujian)) }}" class="btn btn-primary btn-block"><i class="fas fa-book fa-3x"></i><br><span class="text-center"><i>Daftar Nilai</i></span></a>
                                </div>
                                <div class="col-sm-9">
                                    <div class="btn-group btn-block">
                                        @foreach($ujianRemedial as $ur => $isiUR)
                                            @if($isiUR->id_ujian == $u->id_ujian)
                                                <button class="btn btn-info btn-membesar half PostRemedBtn" data-keberapa="{{$us}}">Post</button>
                                                <button class="btn btn-success btn-membesar half text-light DetailRemedBtn" data-keberapa="{{$us}}">Detail</button>
                                                <?php break; ?>
                                            @elseif($ur == count($ujianRemedial)-1)
                                                <button class="btn btn-secondary btn-disabled btn-membesar half" disabled="">Post</button>
                                                <button class="btn btn-secondary btn-disabled btn-membesar half" disabled="">Detail</button>
                                            @endif
                                        @endforeach
                                        <?php $jumlahUjianRemed = 0; ?>
                                        @foreach($sRemed as $sr => $isiSR)
                                            @if($u->id_ujian == $isiSR->id_ujian)
                                                <?php 
                                                    $jumlahUjianRemed++; 
                                                ?>
                                            @endif
                                        @endforeach

                                        @foreach($sRemed as $sr => $isiSR)
                                            @if(date('Y-m-d') > $u->tanggal_kadaluarsa && $jumlahUjianRemed < 3)
                                                <button class="btn btn-primary btn-membesar half AddRemedBtn" data-keberapa="{{$us}}">Add</button>
                                                <?php break; ?>
                                            @elseif($sr == count($sRemed)-1)
                                                <button class="btn btn-secondary btn-disabled btn-membesar half">Add</button>
                                            @endif
                                        @endforeach
                                    </div>
                                    
                                    <div class="btn-group btn-block menuAddRemed_{{$us}}" aria-expanded="false" style="display:none">
                                        @if($jumlahUjianRemed == 2)
                                            <a class="btn btn-secondary btn-membesar half" disabled="">Remed 1</a>
                                            <a class="btn btn-secondary btn-membesar half" disabled="">Remed 2</a>
                                            <a class="btn btn-primary btn-membesar half" href="{{ url('guru/ujian/remed/add', base64_encode($u->id_ujian)) }}">Remed 3</a>
                                        @elseif($jumlahUjianRemed == 1)
                                            <a class="btn btn-secondary btn-membesar half" disabled="">Remed 1</a>
                                            <a class="btn btn-primary btn-membesar half" href="{{ url('guru/ujian/remed/add', base64_encode($u->id_ujian)) }}">Remed 2</a>
                                            <a class="btn btn-secondary btn-membesar half" disabled="">Remed 3</a>
                                        @elseif($jumlahUjianRemed == 0)
                                            <a class="btn btn-primary btn-membesar half" href="{{ url('guru/ujian/remed/add', base64_encode($u->id_ujian)) }}">Remed 1</a>
                                            <a class="btn btn-secondary btn-membesar half" disabled="">Remed 2</a>
                                            <a class="btn btn-secondary btn-membesar half" disabled="">Remed 3</a>
                                        @endif
                                    </div>

                                    <div class="btn-group btn-block menuDetailRemed_{{$us}}" aria-expanded="false" style="display:none">
                                        @foreach($sRemed as $sr => $isiSR)    
                                            @if($u->id_ujian == $isiSR->id_ujian)
                                                @if($isiSR->remed_ke == 1)
                                                    <a href="{{ url('guru/ujian/remed/detail', base64_encode($isiSR->id_ujian_remedial)) }}" class="btn btn-success btn-membesar half">Remed 1</a>
                                                    <?php break; ?>
                                                @elseif($sr == count($sRemed)-1)
                                                    <a class="btn btn-secondary btn-membesar half" disabled="">Remed 1</a>
                                                @endif
                                                
                                            @elseif($sr == count($sRemed)-1)
                                                <a class="btn btn-secondary btn-membesar half" disabled="">Remed 1</a>
                                            @endif
                                        @endforeach

                                        @foreach($sRemed as $sr => $isiSR)    
                                            @if($u->id_ujian == $isiSR->id_ujian)
                                                @if($isiSR->remed_ke == 2)
                                                    <a href="{{ url('guru/ujian/remed/detail', base64_encode($isiSR->id_ujian_remedial)) }}" class="btn btn-success btn-membesar half">Remed 2</a>
                                                    <?php break; ?>
                                                @elseif($sr == count($sRemed)-1)
                                                    <a class="btn btn-secondary btn-membesar half" disabled="">Remed 2</a>
                                                @endif
                                                
                                            @elseif($sr == count($sRemed)-1)
                                                <a class="btn btn-secondary btn-membesar half" disabled="">Remed 2</a>
                                            @endif
                                        @endforeach

                                        @foreach($sRemed as $sr => $isiSR)    
                                            @if($u->id_ujian == $isiSR->id_ujian)
                                                @if($isiSR->remed_ke == 3)
                                                    <a href="{{ url('guru/ujian/remed/detail', base64_encode($isiSR->id_ujian_remedial)) }}" class="btn btn-success btn-membesar half">Remed 3</a>
                                                    <?php break; ?>
                                                @elseif($sr == count($sRemed)-1)
                                                    <a class="btn btn-secondary btn-membesar half" disabled="">Remed 3</a>
                                                @endif
                                                
                                            @elseif($sr == count($sRemed)-1)
                                                <a class="btn btn-secondary btn-membesar half" disabled="">Remed 3</a>
                                            @endif
                                        @endforeach
                                    </div>

                                    <div class="btn-group btn-block menuPostRemed_{{$us}}" aria-expanded="false" style="display:none">
                                        @foreach($ujianRemedial as $ur => $isiUR)
                                            @if($isiUR->id_ujian == $u->id_ujian)
                                                @if($isiUR->remed_ke == 1 && $isiUR->status == 'Belum Selesai')
                                                    <a class="btn btn-info btn-membesar half text-light" data-toggle="modal" data-target="#post_remed_{{$us}}_{{$isiUR->remed_ke}}">Remed 1</a>
                                                    <?php break; ?>
                                                @elseif($isiUR->remed_ke == 1 && $isiUR->status == 'posted')
                                                    <button type="button" class="btn btn-danger btn-membesar half unpostModal" href="{{url('/guru/ujian/remed/draft', base64_encode($isiUR->id_ujian_remedial))}}">Remed 1</button>
                                                    <?php break; ?>
                                                @elseif($ur == count($ujianRemedial)-1)
                                                    <a class="btn btn-secondary btn-membesar half" disabled="">Remed 1</a>
                                                @endif
                                            @elseif($ur == count($ujianRemedial)-1)
                                                <a class="btn btn-secondary btn-membesar half" disabled="">Remed 1</a>
                                            @endif
                                        @endforeach
                                        
                                        @foreach($ujianRemedial as $ur => $isiUR)
                                            @if($isiUR->id_ujian == $u->id_ujian)
                                                @if($isiUR->remed_ke == 2 && $isiUR->status == 'Belum Selesai')
                                                    <a class="btn btn-info btn-membesar half text-light" data-toggle="modal" data-target="#post_remed_{{$us}}_{{$isiUR->remed_ke}}">Remed 2</a>
                                                    <?php break; ?>
                                                @elseif($isiUR->remed_ke == 2 && $isiUR->status == 'posted')
                                                    <button type="button" class="btn btn-danger btn-membesar half unpostModal" href="{{url('/guru/ujian/remed/draft', base64_encode($isiUR->id_ujian_remedial))}}">Remed 2</button>
                                                    <?php break; ?>
                                                @elseif($ur == count($ujianRemedial)-1)
                                                    <a class="btn btn-secondary btn-membesar half" disabled="">Remed 2</a>
                                                @endif
                                            @elseif($ur == count($ujianRemedial)-1)
                                                <a class="btn btn-secondary btn-membesar half" disabled="">Remed 2</a>
                                            @endif
                                        @endforeach
                                        
                                        @foreach($ujianRemedial as $ur => $isiUR)
                                            @if($isiUR->id_ujian == $u->id_ujian)
                                                @if($isiUR->remed_ke == 3 && $isiUR->status == 'Belum Selesai')
                                                    <a class="btn btn-info btn-membesar half text-light" data-toggle="modal" data-target="#post_remed_{{$us}}_{{$isiUR->remed_ke}}">Remed 3</a>
                                                    <?php break; ?>
                                                @elseif($isiUR->remed_ke == 3 && $isiUR->status == 'posted')
                                                    <button type="button" class="btn btn-danger btn-membesar half unpostModal" href="{{url('/guru/ujian/remed/draft', base64_encode($isiUR->id_ujian_remedial))}}">Remed 3</button>
                                                    <?php break; ?>
                                                @elseif($ur == count($ujianRemedial)-1)
                                                    <a class="btn btn-secondary btn-membesar half" disabled="">Remed 3</a>
                                                @endif
                                            @elseif($ur == count($ujianRemedial)-1)
                                                <a class="btn btn-secondary btn-membesar half" disabled="">Remed 3</a>
                                            @endif
                                        @endforeach
                                    </div>

                                </div>
                            </div>
                        </div>    
                        <div class="card-footer">
                            <small class="text-muted">Di buat oleh {{ $u->nama }} pada {{ $u->tanggal_post }}</small>
                        </div>
                    </div>  
                </div>
            @endforeach
            <div class="row">
                <div class="col-3">
                    <div class="btn-float-add-ujian">
                        <a href="{{ url('guru/ujian/add') }}" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Tambah Data Ujian"><i class="fas fa-plus"></i></a>
                    </div>
                </div>
                <div class="col-9">
                    <div class="float-right">
                        {{ $ujian->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

@foreach($ujian as $us => $u)
    <div id="post_{{$us}}" class="modal fade text-dark" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="post-data_{{$us}}" method="POST" action="{{url('/ujian/post', base64_encode($u->id_ujian))}}">
                    {{ csrf_field() }}
                    <div class="modal-header">
                        <h4 class="modal-title">Pilih Kelas</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <p>Silahkan pilih kelas-kelas yang akan diberikan soal</p>
                        <select name="kelas[]" id="kelas_{{$us}}" class="form-control selectpicker show-tick" data-live-search="true" multiple data-selected-text-format="values" data-style="form-control" data-size="5" multiple>
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
@endforeach
@foreach($ujian as $us => $u)
    @foreach($sRemed as $sR => $isiSR)
        {{$isiSR->id_ujian}}
        @if($u->id_ujian == $isiSR->id_ujian)
        <div id="post_remed_{{$us}}_{{$isiSR->remed_ke}}" class="modal fade text-dark" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form id="post-remed_{{$u}}" action="{{ url('/guru/ujian/remed/post', base64_encode($isiSR->id_ujian_remedial)) }}" method="POST">
                        {{ csrf_field() }}
                        <div class="modal-header">
                            <h4>Post Ujian Remed</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
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
            </div>
        </div>
        @endif
    @endforeach
@endforeach

@endsection

@section('js')
<script>
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

        $('.deleteButton').on('click', function(){
            var $url = $(this).attr('href');
            swal({
                title: 'Hapus data ?',
                text: 'Jika data ujian dihapus maka data yang bersangkutan akan ikut terhapus juga.',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Okelah, hapus aja!',
            }).then((result) =>{
                window.location.replace($url);
            });
        });
    });

    $('.unpostModal').on('click', function(){
        var $url = $(this).attr('href');
        swal({
            title: 'Unpost ujian ?',
            text: 'Jika data ujian di unpost maka ujian tidak akan ditampilkan kepada siswa.',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Okelah, unpost aja!',
        }).then((result) =>{
            window.location.replace($url);
        });
    });
</script>
@endsection