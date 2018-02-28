@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                @foreach($jumlahNilai as $n)
                    <div class="block">
                        <button type="button" class="btn btn-primary btn-block">{{ $n['nama_kelas'] }}</button>
                    </div>
                    @foreach($nilai as $naila)
                        {{ $naila['nama_kelas'] }}
                        @if($naila['nama_kelas'] == $n['nama_kelas'])
                            {{ $naila['nama'] }}
                        @endif
                    @endforeach
                @endforeach
            </div>
        </div>
    </div>
@endsection
