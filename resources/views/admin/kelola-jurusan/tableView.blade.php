@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Data Jurusan</div>

                <div class="panel-body">
                    <div class="table-responsive">
                        @if(count($jurusan) > 0)
                        <table class="table table-bordered" id="tableSiswa" data-page-length='5'>
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nama Jurusan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php $no=1; ?>
                                    @foreach($jurusan as $s)
                                        <tr>
                                            <td><?php echo $no++; ?></td>
                                            <td>{{$s->nama_jurusan}}</td>
                                            <td>
                                                @if(Auth::user()->hak_akses == 'admin')<a href="{{url('/kelola-jurusan/edit', base64_encode($s->id_jurusan))}}" class="btn btn-primary"><i class="fa fa-edit" aria-hidden="true"></i></a>@endif
                                                @if(Auth::user()->hak_akses == 'admin')<a href="{{url('/kelola-jurusan/delete', base64_encode($s->id_jurusan))}}" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></a>@endif
                                            </td>
                                        </tr>
                                    @endforeach
                            </tbody>
                        </table>

                        @else
                            <strong><p>Data tidak tersedia.</p></strong>
                        @endif
                    </div>
                </div>
                <div class="panel-footer pull-right">
                    <a href="{{ url('/kelola-jurusan/create') }}" class="btn btn-success">Daftarkan jurusan</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
