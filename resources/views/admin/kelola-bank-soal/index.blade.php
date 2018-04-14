@extends('layouts.app')
@section('css')
<style type="text/css">

</style>
@endsection
@section('content')
    <div class="container">
        <a href="{{ url('kelola-bank-soal/create') }}" class="btn btn-primary btn-fixed-bottom-right z-top"><i class="fa fa-plus" aria-hidden="false"> Daftarkan guru</i></a>
        <div class="row">
            <div class="col-md-10 col-md-offset-1">

                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h1>Bank Soal</h1>
                    </div>
                    <div class="panel-body">
                        
                        @if(count($banksoal) > 0)
                        <table class="table table-bordered" id="tablebanksoal" data-page-length='3'>
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Bidang Keahlian</th>
                                    <th>Tipe</th>
                                    <th>Soal</th>
                                    <th>Pilihan</th>
                                    <th>Jawaban</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($banksoal as $key => $isibanksoal)
                                    <tr>
                                        <td class="id_bank_banksoal">{{ $key+1 }}</td>
                                        <td>{{ $isibanksoal->daftarBidangKeahlian['bidang_keahlian'] }}</td>
                                        <td>{!! $isibanksoal->tipe !!}</td>
                                        <td>{!! $isibanksoal->isi_soal !!}</td>
                                        <td>{!! $isibanksoal->pilihan !!}</td>
                                        <td>{!! $isibanksoal->jawaban !!}</td>
                                        <td>
                                            <a href="{{ url('kelola-bank-soal/edit', base64_encode($isibanksoal->id_bank_soal)) }}" class="btn btn-primary" id="editsoal" data-toggle="tooltip" title="Edit Banksoal"><i class="fa fa-edit"></i></a>

                                            <a href="{{ url('kelola-bank-soal/delete', $isibanksoal->id_bank_soal) }}" class="btn btn-success removeBank" id="deletesoal" data-toggle="tooltip" title="Hapus Banksoal"><i class="fa fa-trash"></i></a> 
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        @else
                            <strong><p>Data tidak tersedia.</p></strong>
                        @endif
                    </div>
                     <!-- <div class="panel-footer">
                         <a href="{{ url('kelola-bank-soal/create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah Banksoal</a>
                     </div> -->
                </div>

                </div>
            </div>
        </div>

        
@endsection
@section('js')
<script type="text/javascript">
    $('#kelola').addClass('active open');
    $('#bank_soal').addClass('active');
    // $(document).ready(function(){
    //     $('[data-toggle="tooltip"]').tooltip();   
    // });
</script>
@endsection                                                                                         