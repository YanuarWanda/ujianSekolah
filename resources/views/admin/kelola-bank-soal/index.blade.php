@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h1>Bank Soal</h1>
                    </div>
                    <div class="panel-body">
                        
                        @if(count($banksoal) > 0)
                        <table class="table table-bordered" id="tablebanksoal" data-page-length='3'>
                            <thead>
                                <tr>
                                    <th>#</th>
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
                                        <td class="row">
                                            
                                             <a href="{{ url('kelola-bank-soal/edit', base64_encode($isibanksoal->id_bank_soal)) }}" class="btn btn-primary" id="editsoal"><i class="fa fa-edit" style="margin-right: 5px;"></i> Edit banksoal</a>

                                             <a href="{{ url('kelola-bank-soal/delete', $isibanksoal->id_bank_soal) }}" class="btn btn-success remove" id="deletesoal"><i class="fa fa-trash"></i> Delete banksoal</a> 
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        @else
                            <strong><p>Data tidak tersedia.</p></strong>
                        @endif
                    </div>
                     <div class="panel-footer">
                         <a href="{{ url('kelola-bank-soal/create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> tambah banksoal</a>
                     </div>
                </div>

                </div>
            </div>
        </div>

        
@endsection
@section('js')
<script type="text/javascript">
    $('#kelola').addClass('active open');
    $('#bank_soal').addClass('active');
</script>
@endsection                                                                                         