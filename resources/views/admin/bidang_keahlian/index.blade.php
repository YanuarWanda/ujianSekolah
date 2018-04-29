@extends('layouts/app')

@section('content')
@include('layouts/navbar/navbar_admin')
            <div class="content p-4">
                <h1 class="text-center">Tabel Data Bidang Keahlian</h1>
                <div class="table-responsive-md">
                    <table class="table table-striped table-bordered table-hover datatables" id="tabelDataBidangKeahlian">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama Bidang Keahlian</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            @foreach($bidangKeahlian as $j)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $j->bidang_keahlian }}</td>
                                    <td>
                                        <div class="btn-group btn-block">
                                            <a href="{{ url('bidang_keahlian/edit', base64_encode($j->id_daftar_bidang)) }}" class="btn btn-block btn-primary"><i class="fas fa-fw fa-edit"></i></a>
                                            <button type="buton" href="{{ url('bidang_keahlian/delete', base64_encode($j->id_daftar_bidang)) }}" class="btn btn-danger deleteButton"><i class="fas fa-trash"></i></a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>    
                    <hr>
                    <a href="{{ url('bidang_keahlian/add') }}" class="btn btn-block btn-info" data-toggle="tooltip" data-placement="bottom" title="Tambah Data Bidang Keahlian"><i class="fas fa-plus"></i></a>
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
        $('#sidebar-menu-bidang-keahlian').addClass('active');
    });
    
    $(document).ready(function(){
        $('#tabelDataBidangKeahlian tbody').on('click', '.deleteButton', function(){
            var $url = $(this).attr('href');
            swal({
                title: 'Hapus data ?',
                text: 'Jika data bidang keahlian dihapus maka data yang bersangkutan akan ikut terhapus juga.',
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