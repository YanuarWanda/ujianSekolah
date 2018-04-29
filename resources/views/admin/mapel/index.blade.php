@extends('layouts/app')

@section('content')
@include('layouts/navbar/navbar_admin')
            <div class="content p-4">
                <h1 class="text-center">Tabel Data Mapel</h1>
                <div class="table-responsive-md">
                    <table class="table table-striped table-bordered table-hover datatables" id="tabelDataMapel">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Mata Pelajaran</th>
                                <th>Bidang Keahlian</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            @foreach($mapel as $m)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $m->nama_mapel }}</td>
                                    <td>{{ $m->bidang_keahlian }}</td>
                                    <td>
                                        <div class="btn-group btn-block">
                                            <a href="{{ url('mapel/edit', base64_encode($m->id_mapel)) }}" class="btn btn-block btn-primary"><i class="fas fa-edit"></i></a>
                                            <button type="button" href="{{ url('mapel/delete', base64_encode($m->id_mapel)) }}" class="btn btn-danger deleteButton"><i class="fas fa-trash"></i></a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <hr>
                    <a href="{{ url('mapel/add') }}" class="btn btn-block btn-info" data-toggle="tooltip" data-placement="bottom" title="Tambah Data Mapel"><i class="fas fa-plus"></i></a>
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
        $('#sidebar-menu-mapel').addClass('active');
    });
    
    $(document).ready(function(){
        $('#tabelDataMapel tbody').on('click', '.deleteButton', function(){
            var $url = $(this).attr('href');
            swal({
                title: 'Hapus data ?',
                text: 'Jika data mapel dihapus maka data yang bersangkutan akan ikut terhapus juga.',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Okelah, hapus aja!',
            }).then(function(result){
                window.location.replace($url);
            });
        });
    });
</script>
@endsection