@extends('layouts/app')

@section('content')
@include('layouts/navbar/navbar_admin')
            <div class="content p-4">
                <h1 class="text-center">Tabel Data Jurusan</h1>
                <div class="table-responsive-md">
                    <table class="table table-striped table-bordered table-hover datatables" id="tabelDataJurusan">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama Jurusan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            @foreach($jurusan as $j)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $j->nama_jurusan }}</td>
                                    <td>
                                        <div class="btn-group btn-block">
                                            <a href="{{ url('jurusan/edit', base64_encode($j->id_jurusan)) }}" class="btn btn-block btn-primary"><i class="fas fa-fw fa-edit"></i></a>
                                            <button type="buton" href="{{ url('jurusan/delete', base64_encode($j->id_jurusan)) }}" class="btn btn-danger deleteButton"><i class="fas fa-trash"></i></a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>    
                    <hr>
                    <a href="{{ url('jurusan/add') }}" class="btn btn-block btn-info" data-toggle="tooltip" data-placement="bottom" title="Tambah Data Jurusan"><i class="fas fa-plus"></i></a>
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
        $('#sidebar-menu-jurusan').addClass('active');
    });
    
    $(document).ready(function(){
        $('#tabelDataJurusan tbody').on('click', '.deleteButton', function(){
            var $url = $(this).attr('href');
            swal({
                title: 'Hapus data ?',
                text: 'Jika data jurusan dihapus maka data yang bersangkutan akan ikut terhapus juga.',
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