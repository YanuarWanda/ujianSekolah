@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    <a href="/kelola-guru" class="btn btn-primary">Kelola Guru</a>
                    <a href="/kelola-siswa" class="btn btn-success">Kelola Siswa</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection