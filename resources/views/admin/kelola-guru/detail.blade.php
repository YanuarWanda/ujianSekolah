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
                            <td>Foto Profil</td>
                            <td>
                                <?php if($data->foto != 'nophoto.jpg'){?>
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
                            <td>
                                @foreach($data->bidangKeahlian as $bidangKeahlian)
                                    {{ $bidangKeahlian->daftarBidangKeahlian->bidang_keahlian }},
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <td>Alamat</td>
                            <td>{{$data->alamat}}</td>
                        </tr>
                        <tr>
                            <td>Jenis Kelamin</td>
                            <td>@if($data->jenis_kelamin == 'L') Laki-laki @else Perempuan @endif</td>
                        </tr>
                    </table>

                    <a href="/kelola-guru" class="btn btn-info">Back</a>
                    <a href="{{url('/kelola-guru/edit', base64_encode($data->id_guru))}}" class="btn btn-primary">Edit</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script type="text/javascript">
    $('#kelola').addClass('active open');
  $('#guru').addClass('active');
</script>
@endsection