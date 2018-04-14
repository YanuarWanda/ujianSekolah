@extends('layouts.app')

@section('content')
<div class="container">
    <a href="{{url('/kelola-mapel/create')}}" class="btn btn-primary btn-fixed-bottom-right z-top"><i class="fa fa-plus" aria-hidden="false"> Daftarkan mapel</i></a>
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Data Mata Pelajaran</div>

                <div class="panel-body">
                    <div class="table-responsive">
                        @if(count($mapel) > 0)
                        <table class="table table-bordered" id="tableDaftarBidangKeahlian">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nama Mata Pelajaran</th>
                                    <th>Nama Bidang Keahlian</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php $no=1; ?>
                                    @foreach($mapel as $s)
                                        <tr>
                                            <td><?php echo $no;$no++; ?></td>
                                            <td>{{$s->nama_mapel}}</td>
                                            <td>{{$s['daftar_bidang_keahlian']['bidang_keahlian']}}</td>
                                            <td>
                                                @if(Auth::user()->hak_akses == 'admin')<a href="{{url('/kelola-mapel/edit', base64_encode($s->id_mapel))}}" class="btn btn-primary"><i class="fa fa-edit" aria-hidden="true"></i></a>@endif
                                                @if(Auth::user()->hak_akses == 'admin')<a href="{{url('/kelola-mapel/delete', base64_encode($s->id_mapel))}}" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></a>@endif
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
                    <a href="{{ url('/kelola-mapel/create') }}" class="btn btn-success">Daftarkan Mata Pelajaran</a>
                </div> -->
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script type="text/javascript">
    $('#kelola').addClass('active open');
  $('#mapel').addClass('active');
</script>
@endsection