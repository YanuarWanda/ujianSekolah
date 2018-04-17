@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                @if(Auth::user()->hak_akses == 'admin')
                <div class="panel-heading">
                    <span class="panel-title">Data Siswa | 
                        <button id="export" class="btn-sm btn-success">Export ke Excel</button>
                        |
                        <button id="export-pdf" class="btn-sm btn-success">Export ke Pdf</button>
                    </span>
                    <div class="pull-right">
                        <a href="{{ route('siswa.import') }}" class="btn-sm btn-success">Import Data  Siswa</a>
                        <a href="{{ url('/kelola-siswa/create') }}" class="btn-sm btn-success">Daftarkan siswa</a>
                        <a href="{{ url('/kelola-siswa/naik-kelas') }}" class="btn-sm btn-success">Kenaikan Kelas</a>
                    </div>
                </div>
                @endif

                <div class="panel-body">
                    <div class="table-responsive">
                        @if(count($siswa) > 0)
                        <table class="table table-bordered" id="tableSiswa" data-page-length='6'>
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
                                                <a href="{{url('/kelola-siswa/show', base64_encode($s->id_siswa))}}" class="btn btn-warning"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                                @if(Auth::user()->hak_akses == 'admin')<a href="{{url('/kelola-siswa/edit', base64_encode($s->id_siswa))}}" class="btn btn-primary"><i class="fa fa-edit" aria-hidden="true"></i></a>@endif
                                                @if(Auth::user()->hak_akses == 'admin')<button type="button" href="{{url('/kelola-siswa/delete', base64_encode($s->id_siswa))}}" class="btn btn-danger removeSiswa"><i class="fa fa-trash" aria-hidden="true"></i></button>@endif
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
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script type="text/javascript">
    $('#export').click(function() {
        swal({
          title: 'Export Data ?',
          text: 'Data yang di Export akan otomatis terdownload',
          type: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
        }).then((data) => {
            window.location = '{{ route('siswa.export') }}';
        })
    });

    $('#export-pdf').click(function() {
        swal('Error', 'Maaf, fitur belum tersedia.', 'error');
        // swal({
        //   title: 'Export Data ?',
        //   text: 'Export dalam bentuk Pdf',
        //   type: 'warning',
        //   showCancelButton: true,
        //   confirmButtonColor: '#3085d6',
        //   cancelButtonColor: '#d33',
        // }).then((data) => {
        //     window.location = '{{ route('siswa.export-pdf') }}';
        // })
    });
</script>
@endsection
