@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 col-md-offset-2">
            <div class="card">
                <h1 class="card-header text-center">Dashboard</h1>
                <div class="card-block">
                    <p class="card-text">a</p>
                    <a href="/kelola-guru" class="btn btn-primary">Kelola Guru</a>
                    <a href="/kelola-siswa" class="btn btn-success">Kelola Siswa</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
