@extends('layouts/app')

@section('content')
@include('layouts/navbar/navbar_admin')
            <div class="content p-4">
                <h1 class="text-center">Tabel Data Guru</h1>
                <div class="table-responsive-md">
                    <table class="table table-striped table-bordered table-hover datatables" id="tableGuru">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>NIP</th>
                                <th>Nama</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            @foreach($guru as $g)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $g->nip }}</td>
                                    <td>{{ $g->nama }}</td>
                                    <td>
                                        <div class="btn-group btn-block">
                                            <a href="{{ url('guru/edit', base64_encode($g->id_guru)) }}" class="btn btn-block btn-primary"><i class="fas fa-fw fa-edit"></i></a>
                                            <button type="button" class="btn btn-danger deleteButton" href="{{ url('guru/delete', base64_encode($g->id_guru)) }}"><i class="fas fa-fw fa-trash"></i></a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <hr>
                <div class="btn-group btn-block">
                    <a type="button" href="{{ url('guru/import') }}" class="btn btn-membesar btn-primary" data-toggle="tooltip" data-placement="bottom" title="Import Data Guru"><i class="fas fa-fw fa-upload"></i></a>
                    <a type="button" href="{{ url('guru/add') }}" class="btn btn-membesar btn-info" data-toggle="tooltip" data-placement="bottom" title="Tambah Data Guru"><i class="fas fa-fw fa-plus"></i></a>
                    <button id="export" class="btn btn-membesar btn-primary" data-toggle="tooltip" data-placement="bottom" title="Export Data Guru"><i class="fas fa-fw fa-download"></i></button>
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
        $('#sidebar-menu-guru').addClass('active');
    });

    $(document).ready(function(){
        $('#tableGuru tbody').on('click', '.deleteButton', function(){
            var $url = $(this).attr('href');
            swal({
                title: 'Hapus Data ?',
                text: 'Jika data guru dihapus maka data yang bersangkutan akan ikut terhapus.',
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
                title: 'Export Data ?',
                text: 'Data yang di Export akan otomatis terdownload',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
            }).then((data) => {
                window.location = '{{ url("guru/export") }}';
            })
        });
    });
</script>
@endsection