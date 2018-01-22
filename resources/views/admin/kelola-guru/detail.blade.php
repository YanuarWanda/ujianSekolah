@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-success">
                <div class="panel-heading">{{$data->user->username}} | {{$data->user->email}}</div>

                <div class="panel-body">
                    <table class="table table-bordered">
                        <tr>
                            <td>Foto Profil</td>
                            <td>
                                <?php if(empty($data->foto) == false){?>
                                <img src="{{asset('storage/foto-profil/'.$data->foto)}}" width="250px"/></td>
                                <?php }else{ ?>
                                <img src="{{asset('image/nophoto.jpg')}}" width="250px"/></td>
                                <?php } ?>
                        </tr>
                        <tr>
                            <td>NIP</td>
                            <td>{{$data->nip}}</td>
                        </tr>
                        <tr>
                            <td>Nama</td>
                            <td>{{$data->nama}}</td>
                        </tr>
                        <tr>
                            <td>Bidang Keahlian</td>
                            <td>{{$data->bidang_keahlian}}</td>
                        </tr>
                        <tr>
                            <td>Alamat</td>
                            <td>{{$data->alamat}}</td>
                        </tr>
                        <tr>
                            <td>Jenis Kelamin</td>
                            <td>{{$data->jenis_kelamin}}</td>
                        </tr>
                    </table>

                    <a href="/kelola-guru" class="btn btn-info">Back</a>
                    <a href="{{url('/kelola-guru/edit', base64_encode($data->nip))}}" class="btn btn-primary">Edit</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
