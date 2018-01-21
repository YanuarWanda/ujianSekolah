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

                    <a href="/kelola-guru" class="btn btn-primary">Back</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection