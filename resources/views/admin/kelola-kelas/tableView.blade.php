@extends('layouts.app')

@section('content')
<div class="container fluid">
    <a href="{{url('/kelola-kelas/create')}}" class="btn btn-primary btn-fixed-bottom-right z-top"><i class="fa fa-plus" aria-hidden="false"> Daftarkan kelas</i></a>
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Data Kelas</div>

                <div class="panel-body">
                    <div class="table-responsive">
                        @if(count($kelas) > 0)
                        <table class="table table-bordered" id="tableSiswa">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nama Kelas</th>
                                    <th>Jurusan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php $no=1; ?>
                                    @foreach($kelas as $s)
                                        <tr>
                                            <td><?php echo $no;$no++; ?></td>
                                            <td>{{$s->nama_kelas}}</td>
                                            <td>{{$s->jurusan->nama_jurusan}}</td>
                                            <td>
                                                @if(Auth::user()->hak_akses == 'admin')<a href="{{url('/kelola-kelas/edit', base64_encode($s->id_kelas))}}" class="btn btn-primary"><i class="fa fa-edit" aria-hidden="true"></i></a>@endif
                                                @if(Auth::user()->hak_akses == 'admin')<a href="{{url('/kelola-kelas/delete', base64_encode($s->id_kelas))}}" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></a>@endif
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
                <!-- <div class="panel-footer pull-right">
                    <a href="{{ url('/kelola-kelas/create') }}" class="btn btn-success">Daftarkan kelas</a>
                </div> -->
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script type="text/javascript">
    $('#kelola').addClass('active open');
  $('#kelas').addClass('active');
</script>
@endsection