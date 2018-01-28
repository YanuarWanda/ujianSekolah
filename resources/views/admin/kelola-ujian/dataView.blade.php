@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @foreach($ujian as $u)
                <div class="panel panel-default">
                    <div class="panel-heading">{{$u->id_ujian}}</div>
                    <div class="panel-body">
                        ABCDEFGHIJKLMNOPQRSTUVWXYZ
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
