@extends('layouts/app')

@section('css')
<style>
.img-custom{
    width: 100%;
    height: 100%;
    cursor: pointer;
}
.img-custom:hover{
    opacity: 0.5;
    transition: 1s;
}
</style>
@endsection

@section('content')
@include('layouts/navbar/navbar_guru')
    <div class="container text-dark">
        <div class="card mt-3 mb-3">
            <div class="card-header">
                <h1 class="text-center">Daftar Siswa</h1>
            </div>
            <div class="card-body">
                <div class="row">
                    @foreach($siswa as $s)
                        <div class="col-lg-3 col-md-6 mb-3">
                            <div class="card">
                                <div class="card-header bg-main p-1 text-center">{{ $s->nama }}</div>   
                                <div class="card-body p-0">
                                   <a href="{{ url('guru/siswa/profil', base64_encode($s->id_siswa)) }}"><img @if($s->foto != 'nophoto.jpg') src="{{ asset('storage/foto-profil/'.$s->foto) }}" @else src="{{ asset('image/nophoto.jpg') }}" @endif alt="{{ $s->nama }}" class="img-custom"></a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="card-footer">
                <div class="float-right">
                    {{ $siswa->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection