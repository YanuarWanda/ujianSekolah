@extends('layouts/app')

@section('content')
@include('layouts/navbar/navbar_admin')
            <div class="content p-4">
                <h1 class="text-center">Tabel Data Kelas</h1>
                <div class="table-responsive-md">
                    <table class="table table-striped table-bordered table-hover datatables" id="tabelDataKelas">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Kelas</th>
                                <th>Jurusan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            @foreach($kelas as $k)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $k->nama_kelas }}</td>
                                    <td>{{ $k->nama_jurusan }}</td>
                                    <td>
                                        <div class="btn-group btn-block">
                                            <a href="{{ url('kelas/edit', base64_encode($k->id_kelas)) }}" class="btn btn-block btn-primary"><i class="fas fa-fw fa-edit"></i></a>
                                            <button type="buton" href="{{ url('kelas/delete', base64_encode($k->id_kelas)) }}" class="btn btn-danger deleteButton"><i class="fas fa-trash"></i></a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>    
                    <hr>
                    <a href="{{ url('kelas/add') }}" class="btn btn-block btn-info" data-toggle="tooltip" data-placement="bottom" title="Tambah Data Kelas"><i class="fas fa-plus"></i></a>
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
        $('#sidebar-menu-kelas').addClass('active');
    });
    
    $(document).ready(function(){
        $('#tabelDataKelas tbody').on('click', '.deleteButton', function(){
            var $url = $(this).attr('href');
            swal({
                title: 'Hapus data ?',
                text: 'Jika data kelas dihapus maka data yang bersangkutan akan ikut terhapus juga.',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Okelah, hapus aja!',
            }).then((result) =>{
                window.location.replace($url);
            });
        });
    });
</script>
@endsection