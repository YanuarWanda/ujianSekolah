@extends('layouts.app')

@section('content')
    <div class="container">
        <a href="{{url('/kelola-ujian/create')}}" class="btn btn-primary btn-fixed-bottom-right"><i class="fa fa-plus" aria-hidden="false"></i></a>
        <div class="row">
            @foreach($ujian as $u)
            <div class="col-sm-12 col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading"><a href="{{url('/kelola-ujian/edit', base64_encode($u->id_ujian))}}">{{$u->id_ujian.". ".$u->judul_ujian}}</a></div>
                    <div class="panel-body">
                        (Deskripsi)<br>
                        Waktu Pengerjaan : {{$u->waktu_pengerjaan}}<br>
                        Batas Pengerjaan : {{$u->tanggal_kadaluarsa}}<br>
                        Status : {{$u->status}}<br>
                        Catatan : {{$u->catatan}}<br>
                    </div>
                    <div class="panel-footer">{{"Di post oleh ".$u->guru->nama.", ".$u->tanggal_post}}</div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
@endsection
