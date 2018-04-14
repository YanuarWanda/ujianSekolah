@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-success">
                <div class="panel-heading">{{$data->user->username}} | {{$data->user->email}}</div>

                <div class="panel-body">
                    <table class="table table-bordered">
                        <tr>
                            <td>Foto</td>
                            <td>
                                <?php if($data->foto != 'nophoto.jpg'){?>
                                <img src="{{asset('storage/foto-profil/'.$data->foto)}}" width="250px"/>
                                <?php }else{ ?>
                                <img src="{{asset('image/nophoto.jpg')}}" width="250px"/>
                                <?php } ?>
                            </td>
                        </tr>
                        <tr>
                            <td>NIS</td>
                            <td>{{$data->nis}}</td>
                        </tr>
                        <tr>
                            <td>Nama</td>
                            <td>{{$data->nama}}</td>
                        </tr>
                        <tr>
                            <td>Kelas</td>
                            <td>{{$data->kelas->nama_kelas}}</td>
                        </tr>
                        <tr>
                            <td>Jurusan</td>
                            <td>{{$data->kelas->jurusan->nama_jurusan}}</td>
                        </tr>
                        <tr>
                            <td>Alamat</td>
                            <td>{{$data->alamat}}</td>
                        </tr>
                        <tr>
                            <td>Jenis Kelamin</td>
                            @if($data->jenis_kelamin == 'L')
                                <td>Laki-laki</td>
                            @else
                                <td>Perempuan</td>
                            @endif
                        </tr>
                    </table>

                    <a href="/kelola-siswa" class="btn btn-info">Back</a>
                    @if(Auth::user()->hak_akses == 'admin')<a href="{{url('/kelola-siswa/edit', base64_encode($data->id_siswa))}}" class="btn btn-primary">Edit</a>@endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script type="text/javascript">
    $('#kelola').addClass('active open');
  $('#siswa').addClass('active');
</script>
@endsection