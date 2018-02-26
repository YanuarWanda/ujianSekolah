@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    <a href="/kelola-siswa" class="btn btn-success">Kelola Siswa</a>
                    <a href="/kelola-ujian" class="btn btn-danger">Kelola Ujian</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
