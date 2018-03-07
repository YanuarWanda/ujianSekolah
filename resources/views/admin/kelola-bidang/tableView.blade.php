@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Data Bidang Keahlian</div>

                <div class="panel-body">
                    <div class="table-responsive">
                        @if(count($daftar_bidang_keahlian) > 0)
                        <table class="table table-bordered" id="tableSiswa">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Bidang Keahlian</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php $no=1; ?>
                                    @foreach($daftar_bidang_keahlian as $d)
                                        <tr>
                                            <td><?php echo $no;$no++; ?></td>
                                            <td>{{$d->bidang_keahlian}}</td>
                                            <td>
                                                @if(Auth::user()->hak_akses == 'admin')<a href="{{url('/kelola-bidang/edit', base64_encode($d->id_daftar_bidang))}}" class="btn btn-primary"><i class="fa fa-edit" aria-hidden="true"></i></a>@endif
                                                @if(Auth::user()->hak_akses == 'admin')<a href="{{url('/kelola-bidang/delete', base64_encode($d->id_daftar_bidang))}}" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></a>@endif
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
                    <a href="{{ url('/kelola-bidang/create') }}" class="btn btn-success">Daftarkan Bidang Keahlian</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
