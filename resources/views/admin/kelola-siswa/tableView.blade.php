@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Data siswa</div>

                <div class="panel-body">
                    <div class="table-responsive">
                        @if(count($siswa) > 0)
                        <table class="table table-bordered" id="tableSiswa">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>NIS</th>
                                    <th>Nama</th>
                                    <th>Kelas</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php $no=1; ?>
                                    @foreach($siswa as $s)
                                        <tr>
                                            <td><?php echo $no;$no++; ?></td>
                                            <td>{{$s->nis}}</td>
                                            <td>{{$s->nama}}</td>
                                            <td>{{$s->kelas->nama_kelas}}</td>
                                            <td>
                                                <a href="{{url('/kelola-siswa/show', base64_encode($s->nis))}}" class="btn btn-warning"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                                @if(Auth::user()->hak_akses == 'admin')<a href="{{url('/kelola-siswa/edit', base64_encode($s->nis))}}" class="btn btn-primary"><i class="fa fa-edit" aria-hidden="true"></i></a>@endif
                                                @if(Auth::user()->hak_akses == 'admin')<a href="{{url('/kelola-siswa/delete', base64_encode($s->nis))}}" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></a>@endif
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
                    <a href="{{ url('/kelola-siswa/create') }}" class="btn btn-success">Daftarkan siswa</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
