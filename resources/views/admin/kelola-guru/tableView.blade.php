@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Data Guru</div>

                <div class="panel-body">
                    <div class="table-responsive">
                        @if(count($guru) > 0)
                        <table class="table table-bordered" id="tableGuru">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>NIP</th>
                                    <th>Nama</th>
                                    <th>Bidang Keahlian</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                <?php $no=1; ?>
                                    @foreach($guru as $g)
                                        <tr>
                                            <td><?php echo $no;$no++; ?></td>
                                            <td>{{$g->nip}}</td>
                                            <td>{{$g->nama}}</td>
                                            <td>{{$g->bidang_keahlian}}</td>
                                            <td>
                                                <a href="{{url('/kelola-guru/show', base64_encode($g->nip))}}" class="btn btn-info">Detail</a>
                                                <a href="{{url('/kelola-guru/edit', base64_encode($g->nip))}}" class="btn btn-primary">Edit</a>
                                                <a href="{{url('/kelola-guru/delete', base64_encode($g->nip))}}" class="btn btn-danger">Delete</a>
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
                    <a href="{{ route('daftar-guru') }}" class="btn btn-success">Daftarkan Guru</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
