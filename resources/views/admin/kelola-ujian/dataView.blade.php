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
                        <br>
                        @if($u->status == 'Draft')
                        <a class="text-center" href="{{url('/kelola-ujian/POST', base64_encode($u->id_ujian))}}">Post Ujian</a>
                        @else
                        <a class="text-center" href="{{url('/kelola-ujian/DRAFT', base64_encode($u->id_ujian))}}">Unpost Ujian</a>
                        @endif
                    </div>
                    <div class="panel-footer">
                        @if(Auth::user()->hak_akses == 'admin'){!!"Di post oleh <span style='color:red;'>Administrator</span>, ".$u->tanggal_post!!}
                        @else {{"Di post oleh ".$u->guru['nama'].", ".$u->tanggal_post}}
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
            @else
            <p>Data not available.</p>
            @endif
        </div>
    </div>
@endsection
