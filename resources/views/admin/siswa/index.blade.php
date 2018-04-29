@extends('layouts/app')

@section('content')
@include('layouts/navbar/navbar_admin')
            <div class="content p-4">
                <h1 class="text-center">Tabel Data Siswa</h1>
                <div class="table-responsive-md">
                    <table class="table table-striped table-bordered table-hover datatables" id="tableSiswa">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>NIS</th>
                                <th>Nama</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            @foreach($siswa as $s)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $s->nis }}</td>
                                    <td>{{ $s->nama }}</td>
                                    <th>
                                        <div class="btn-group btn-block">
                                            <a href="{{ url('siswa/edit', base64_encode($s->id_siswa)) }}" class="btn btn-block btn-primary"><i class="fas fa-fw fa-edit"></i></a>
                                            <button type="button" href="{{ url('siswa/delete', base64_encode($s->id_siswa)) }}" class="btn btn-danger deleteButton"><i class="fas fa-fw fa-trash"></i></a>
                                        </div>
                                    </th>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <hr>
                    <div class="btn-group btn-block">
                        <a type="button" href="{{ url('siswa/import') }}" class="btn btn-membesar btn-primary" data-toggle="tooltip" data-placement="bottom" title="Import Data Siswa"><i class="fas fa-fw fa-upload"></i></a>
                        <a type="button" href="{{ url('siswa/add') }}" class="btn btn-membesar btn-info" data-toggle="tooltip" data-placement="bottom" title="Tambah Data Siswa"><i class="fas fa-fw fa-plus"></i></a>
                        <button id="export" class="btn btn-membesar btn-primary" data-toggle="tooltip" data-placement="bottom" title="Export Data Siswa"><i class="fas fa-fw fa-download"></i></button>
                        <a type="button" href="{{ url('siswa/upgrade') }}" class="btn btn-membesar btn-success" data-toggle="tooltip" data-placement="bottom" title="Upgrade Data Siswa"><i class="fas fa-arrow-up"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
@include('layouts/navbar/navbar_admin_footer')
<script type="text/javascript">
    $(window).on('load', function(){
        $('#sidebar-menu-siswa').addClass('active');
    });

    $(document).ready(function(){
        $('#tableSiswa tbody').on('click', '.deleteButton', function(){
            var $url = $(this).attr('href');
            swal({
                title: 'Hapus data ?',
                text: 'Jika data siswa dihapus maka data yang bersangkutan akan ikut terhapus juga.',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Okelah, hapus aja!',
            }).then((result) =>{
                window.location.replace($url);
            });
        });

        $('#export').click(function() {
            swal({
                title: 'Export data ?',
                text: 'Data yang di Export akan otomatis terdownload',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
            }).then((data) => {
                window.location = '{{ url("siswa/export") }}';
            })
        });
    });
</script>
@endsection