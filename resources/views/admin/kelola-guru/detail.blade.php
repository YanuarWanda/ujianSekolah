@extends('layouts.app')

<style type="text/css">
img {
width: 105px;
height: 105px;
}

</style>

@section('content')
<div class="container-fluid row">
    <div class="col-md-2">
        <div class="foto-profil">
            @if($data->foto == 'nophoto.jpg')
                <img src="{{asset('image/nophoto.jpg')}}"/>
            @else
                <img src="{{asset('storage/foto-profil/'.$data->foto)}}"/>
            @endif
        </div>
    </div>
    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-body">
                <legend>Biodata</legend>      
                <div class="table-responsive">
                <table class="table table-striped">
                    <tr>
                        <td>Nomor Induk Pegawai</td>
                        <td>{{ $data->nip }}</td>
                    </tr>
                    <tr>
                        <td>Nama</td>
                        <td>{{ $data->nama }}</td>
                    </tr>
                    <tr>
                        <td>Jenis Kelamin</td>
                        @if($data->jenis_kelamin == 'P')
                        <td>Perempuan</td>
                        @else
                        <td>Laki-laki</td>
                        @endif
                    </tr>
                </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="panel panel-default">
            <div class="panel-body">
                <legend>Alamat</legend>
                <textarea class="form-control" rows="6" readonly>{{ $data->alamat }}</textarea>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid row">
    <div class="col-md-5">
        <div class="panel panel-default">
            <div class="panel-body">
                <legend>Akun</legend>
                
                <div class="table-responsive">
                <table class="table table-striped">
                    <tr>
                        <td>Username</td>
                        <td>{{ $data->user->username }}</td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td>{{ $data->user->email }}</td>
                    </tr>
                    <tr>
                        <td>Kapan akun dibuat ?</td>
                        <td>{{ $data->user->created_at }}</td>
                    </tr>
                </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="panel panel-default">
            <div class="panel-body">
                <legend>Bidang Keahlian</legend>

                <div class="table-responsive">
                <table class="table table-striped">
                @foreach($data->bidangKeahlian as $bidang)
                    <tr>
                        <td>
                            {{$bidang->daftarBidangKeahlian->bidang_keahlian}} 
                        </td>
                    </tr>
                @endforeach
                </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="panel panel-default">
            <div class="panel-body">
                <a href="{{url('/kelola-guru/edit', base64_encode($data->id_guru))}}" 
                    class="btn btn-warning btn-block"><span class="fa fa-edit"></span> Edit</a>
                <a href="{{url('/kelola-guru/delete', base64_encode($data->id_guru))}}"
                    class="btn btn-danger btn-block remove"><span class="fa fa-trash"></span> Delete</a>
            </div>
        </div>
    </div>
</div>
@endsection
