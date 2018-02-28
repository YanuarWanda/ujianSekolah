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
                    <a href="/kelola-ujian" class="btn btn-danger">Kelola Ujian</a>
                    <a href="/kelola-jurusan" class="btn btn-info">Kelola Jurusan</a>
                    <a href="/kelola-kelas" class="btn btn-warning">Kelola Kelas</a>
                    <a href="/kelola-guru/import" class="btn btn-default">Import data Guru</a>
                    <a href="/kelola-siswa/import" class="btn btn-default">Import data Siswa</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
