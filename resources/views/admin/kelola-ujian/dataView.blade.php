@extends('layouts.app')

@section('content')
    <div class="container">
        <a href="{{url('/kelola-ujian/create')}}" class="btn btn-primary btn-fixed-bottom-right z-top"><i class="fa fa-plus" aria-hidden="false"></i></a>
        <div class="row">
            @if(count($ujian) > 0)
            @foreach($ujian as $u)
            <div class="col-sm-12 col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <a href="{{url('/kelola-ujian/edit', base64_encode($u->id_ujian))}}">{{$u->id_ujian.". ".$u->judul_ujian}}</a>
                        <div class="close-btn">
                            <a href="{{ url('/kelola-ujian/delete', base64_encode($u->id_ujian)) }}"><i class="fa fa-close fa-1x"></i></a>
                        </div>
                    </div>
                    <div class="panel-body">
                        (Deskripsi)<br>
                        Waktu Pengerjaan : {{$u->waktu_pengerjaan}}<br>
                        Batas Pengerjaan : {{$u->tanggal_kadaluarsa}}<br>
                        Status : {{$u->status}}<br>
                        Catatan : {{$u->catatan}}<br>
                        <a class="text-center" href="#">Daftar Nilai</a>
                    </div>
                    <div class="panel-footer">{{"Di post oleh ".$u->guru['nama'].", ".$u->tanggal_post}}</div>
                </div>
            </div>
            @endforeach
            @else
            <p>Data not available.</p>
            @endif
        </div>
    </div>
@endsection
