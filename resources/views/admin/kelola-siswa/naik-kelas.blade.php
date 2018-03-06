@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Data siswa</div>

                <div class="panel-body">
                    <div class="form-group">
                        <label>Pilih Kelas</label>
                        <select id="kelas" class="form-control">
                            @foreach($kelas as $k)
                            <option value="{{ $k->id_kelas }}" @if($k->id_kelas == $idk) selected @endif>{{ $k->nama_kelas }}</option>
                            @endforeach
                        </select>
                    </div>

                    <hr>

                    <div class="table-responsive">
                        @if(count($siswa) > 0)
                        <table class="table table-bordered" id="tableSiswa">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>NIS</th>
                                    <th>Nama</th>
                                    <th>Kelas</th>
                                    <th>Naikan Kelas</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php $no=1; ?>
                                    @foreach($siswa as $s)
                                        <tr>
                                            <td><?php echo $no;$no++; ?></td>
                                            <td>{{$s->nis}}</td>
                                            <td>{{$s->nama}}</td>
                                            <td>{{$s->kelas->nama_kelas}}</td>
                                            <td><a class="btn btn-success" role="button" href="kelola-siswa/naik-kelas">Naikan Kelas</a></td>
                                        </tr>
                                    @endforeach
                            </tbody>
                        </table>

                        @else
                            <strong><p>Data tidak tersedia.</p></strong>
                        @endif
                    </div>
                </div>
                @if(Auth::user()->hak_akses == 'admin')
                <div class="panel-footer pull-right">
                    {{-- <button id="export" class="btn btn-success">Export Data Siswa</button> --}}
                    {{-- <a href="{{ url('/kelola-siswa/create') }}" class="btn btn-success">Daftarkan siswa</a> --}}
                    {{-- <a href="{{ url('/kelola-siswa/naik-kelas') }}" class="btn btn-success">Kenaikan Kelas</a> --}}
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script type="text/javascript">
    $('#kelas').change(function() {
        window.location = "/kelola-siswa/naik-kelas?idk=" + $('#kelas').val() + "";

        // $.ajax({
        //     type: 'GET',
        //     url:  "{{ url('/kelola-siswa/ambil-kelas') }}",
        //     data: {id_kelas: $('#kelas').val()},
        //     beforeSend: function (xhr) {
        //         var token = $('meta[name="csrf_token"]').attr('content');

        //         if (token) {
        //               return xhr.setRequestHeader('X-CSRF-TOKEN', token);
        //         }
        //     },
        //     success: function(data) {
        //         $('div.table-responsive').fadeOut();
        //         $('div.table-responsive').load(data, function() {
        //             $('div.table-responsive').fadeIn();
        //         });

        //         console.log(data);
                
        //     },
        //     error: function(data) {
        //         console.log(data);
        //     },
        //     dataType: 'JSON'
        // });
    });
</script>
@endsection