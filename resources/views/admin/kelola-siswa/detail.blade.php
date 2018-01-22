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
                            <td>{{$data->jurusan}}</td>
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

                    <a href="/kelola-siswa" class="btn btn-info">Back</a>
                    <a href="{{url('/kelola-siswa/edit', base64_encode($data->nis))}}" class="btn btn-primary">Edit</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection