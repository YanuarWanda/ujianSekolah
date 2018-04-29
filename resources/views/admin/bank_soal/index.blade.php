@extends('layouts/app')

@section('content')
@include('layouts/navbar/navbar_admin')
            <div class="content p-4">
                <h1 class="text-center">Tabel Data Bank Soal</h1>
                <div class="table-responsive-md">
                    <table class="table table-striped table-bordered table-hover datatables" id="tabelDataBankSoal">
                        <thead>
                            <tr>    
                                <th>No.</th>
                                <th>Bidang Keahlian</th>
                                <th>Tipe</th>
                                <th>Soal</th>
                                <th>Pilihan</td>
                                <th>Jawaban</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            @foreach($soal as $s)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $s->daftarBidangKeahlian['bidang_keahlian'] }}</td>
                                    <td>{{ $s->tipe }}</td>
                                    <td>{!! $s->isi_soal !!}</td>
                                    <td>{!! $s->pilihan !!}</td>
                                    <td>{!! $s->jawaban !!}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ url('bank_soal/edit', base64_encode($s->id_bank_soal)) }}" class="btn btn-primary"><i class="fas fa-edit"></i></a>
                                            <button type="button" href="{{ url('bank_soal/delete', base64_encode($s->id_bank_soal)) }}" class="btn btn-danger deleteButton"><i class="fas fa-trash"></i></a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <hr>
                    <a href="{{ url('bank_soal/add') }}" class="btn btn-block btn-info" data-toggle="tooltip" data-placement="bottom" title="Tambah Data Bank Soal"><i class="fas fa-plus"></i></a>
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
        $('#sidebar-menu-bank-soal').addClass('active');
    });
    
    $(document).ready(function(){
        $('#tabelDataBankSoal tbody').on('click', '.deleteButton', function(){
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