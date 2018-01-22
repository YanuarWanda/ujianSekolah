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
                                                <a href="{{url('/kelola-siswa/show', base64_encode($s->nis))}}" class="btn btn-warning">Detail</a>
                                                <a href="{{url('/kelola-siswa/edit', base64_encode($s->nis))}}" class="btn btn-primary">Edit</a>
                                                <a href="{{url('/kelola-siswa/delete', base64_encode($s->nis))}}" class="btn btn-danger">Delete</a>
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
