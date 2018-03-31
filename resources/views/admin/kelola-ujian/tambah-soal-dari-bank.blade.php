@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <div class="panel panel-primary">
                    <div class="panel-heading">
                        Tambah Soal dari Bank Soal |  {{ $ujian->judul_ujian }}
                    </div>
                    <div class="panel-body">
                        <h1 class="text-center">Bank Soal</h1>
                        <h4 class="text-center">Bidang Keahlian : {{ $bidangKeahlian }}</h4>
                        @if(count($soal) > 0)
                        <table class="table table-bordered" id="tableSoal">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Tipe</th>
                                    <th>Soal</th>
                                    <th>Jawaban</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($soal as $key => $isiSoal)
                                    <tr>
                                        <td class="id_bank_soal">{{ $key+1 }}</td>
                                        <td>{{ $isiSoal->tipe }}</td>
                                        <td>{!! $isiSoal->isi_soal !!}</td>
                                        <td>{!! $isiSoal->jawaban !!}</td>
                                        <td>
                                            <a class="btn btn-primary" 
                                                {{-- href="{{ Route('tambah-soal', $isiSoal->id_bank_soal) }}" --}}
                                                data-toggle="modal"
                                                data-target="#addModal"
                                                id = "{{ $isiSoal->id_bank_soal }}"
                                            >
                                                <i class="fa fa-plus"></i> Tambahkan soal
                                            </a>
                                            {{-- <button class="btn btn-primary" id="addSoal"><i class="fa fa-plus"></i> Tambahkan soal</button> --}}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        @else
                            <strong><p>Data tidak tersedia.</p></strong>
                        @endif
                    </div>
                </div>

                </div>
            </div>
        </div>

        <!-- Modal -->
        <div id="addModal" class="modal fade" role="dialog">
          <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <form id="addSoal" method="POST">
                {{ csrf_field() }}
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Point</h4>
                  </div>
                  <div class="modal-body">
                    <p>Silahkan tentukan jumlah point untuk soal ini</p>
                    <input type="hidden" name="id_bank_soal" class="form-control">
                    <input type="number" name="point" class="form-control" required>
                  </div>
                  <div class="modal-footer">
                    <button onclick="submit();" class="btn btn-primary" data-dismiss="modal">Post</button>
                  </div>
                </form>
            </div>

          </div>
        </div>
        <!-- Modal -->
@endsection

@section('js')
<script type="text/javascript">
    $('#addModal').on('show.bs.modal', function(e) {
        var $modal = $(this);
        var id = e.relatedTarget.id;

        $modal.find('input[name="id_bank_soal"]').val(id);
    });
</script>
@stop