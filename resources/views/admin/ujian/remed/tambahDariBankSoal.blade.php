@extends('layouts.app')

@section('content')
@include('layouts/navbar/navbar_admin');
<div class="container text-dark">
    <div class="card mt-2 mb-2">
        <div class="card-header">
            <h1 class="text-center">Tambah Soal Dari Bank Soal | {{ $ujianRemedial->ujian->judul_ujian }} Remed</h1>
            <h4 class="text-center">Bidang Keahlian : {{ $bidangKeahlian }}</h4>
        </div>
        <div class="card-body">
            @if(count($soal) > 0)
                <table class="table table-bordered table-hover datatables" id="tabelSoal">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Tipe</th>
                            <th>Soal</th>
                            <th>Jawaban</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($soal as $s => $sIsi)
                            <tr>
                                <td class="idBankSoal">{{ $s+1 }}</td>
                                <td>{{ $sIsi->tipe }}</td>
                                <td>{!! $sIsi->isi_soal !!}</td>
                                <td>{!! $sIsi->jawaban !!}</td>
                                <td>
                                    <a class="btn btn-primary text-light" data-toggle="modal" data-target="#tambahModal" id="{{ $sIsi->id_bank_soal }}"><i class="fas fa-plus">&nbsp;Tambahkan Soal</i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <strong><p>Data tidak tersedia.</p></strong>
            @endif
        </div>
        <div class="card-footer">
            <a href="{{ url('ujian/remed/detail', base64_encode($ujianRemedial->id_ujian_remedial)) }}" class="btn btn-danger btn-block"><i class="fas fa-arrow-left"></i></a>
        </div>
    </div>
</div>

<div class="modal fade text-dark" id="tambahModal" tabindex="-1" role="dialog" aria-hidden="true" aria-labelledby="tambahModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="tambahSoal" method="POST">
                {{ csrf_field() }}
                <div class="modal-header">
                    <h4 class="modal-title">Point</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <p>Silakan tentukan jumlah point untuk soal ini.</p>
                    <input type="hidden" name="id_bank_soal" class="form-control">
                    <input type="number" name="point" id="point" class="form-control" required>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" onClick="submit();" data-dismiss="modal">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
</div>
</div>
@endsection

@section('js')
@include('layouts/navbar/navbar_admin_footer')
<script>
$(window).on('load', function(){
    $('#sidebar-menu-ujian').addClass('active');
});

$('#tambahModal').on('show.bs.modal', function(e) {
    var $modal = $(this);
    var id = e.relatedTarget.id;

    $modal.find('input[name="id_bank_soal"]').val(id);
});
</script>
@endsection()