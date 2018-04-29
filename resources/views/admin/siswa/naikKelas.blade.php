@extends('layouts.app')

@section('content')
@include('layouts/navbar/navbar_admin')
<div class="container p-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header text-center display-4">Data Siswa</div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="kelas">Pilih Kelas</label>
                        <select id="kelas" class="form-control">
                            @foreach($kelas as $k)
                                <option value="{{ $k->id_kelas }}" @if($k->id_kelas == $idk) selected @endif>{{ $k->nama_kelas }}</option>
                            @endforeach
                        </select>
                    </div>
                <!-- </div> -->
 
                <hr>

                <div class="table-responsive">
                    @if(count($siswa) > 0)
                        <table class="table table-bordered" id="tabelSiswa">
                            <thead>
                                <tr>
                                    <th><input type="checkbox" class="select-all checkbox" name="select-all"></th>
                                    <th>NIS</th>
                                    <th>Nama</th>
                                    <th>Kelas</th>
                                    <th>Tahun Ajaran</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($siswa as $s)
                                    <tr>
                                        <td>
                                            <input type="checkbox" class="select-item checkbox" name="select-item" value="{{$s->id_siswa}}"/>
                                        </td>
                                        <td>{{$s->nis}}</td>
                                        <td>{{$s->nama}}</td>
                                        <td>{{$s->kelas->nama_kelas}}</td>
                                        <td>{{$s->tahun_ajaran}}</td>
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
                <div class="card-footer">
                    <button id="select-all" class="btn btn-default">Pilih Semua</button>
                    <button id="select-invert" class="btn btn-default">Balikan</button>
                    <button id="selected" class="btn btn-primary">Upgrade Kelas (Checked)</button>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

@section('js')
@include('layouts/navbar/navbar_admin_footer')
<script>
    $(window).on('load', function(){
        $('#sidebar-menu-siswa').addClass('active');
    });


    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    $('#kelas').change(function() {
        window.location = "/siswa/upgrade?idk=" + $('#kelas').val() + "";
    });

    // Checkbox Table
    $(function(){
        //button select all or cancel
        $("#select-all").click(function () {
            var all = $("input.select-all")[0];
            all.checked = !all.checked
            var checked = all.checked;
            $("input.select-item").each(function (index,item) {
                item.checked = checked;
            });
        });

        //button select invert
        $("#select-invert").click(function () {
            $("input.select-item").each(function (index,item) {
                item.checked = !item.checked;
            });
            checkSelected();
        });

        //button get selected info, Naikan Kelas
        $("#selected").click(function () {
            var items=[];
            $("input.select-item:checked:checked").each(function (index,item) {
                items[index] = item.value;
            });
            if (items.length < 1) {
                alert("Tidak ada siswa yang dipilih");
            }else {
                var values = items.join(',');
                console.log(items);

                $.ajax({
                    type:       "POST",
                    url:        "{{ url('siswa/upgrade') }}",
                    data:       { id_siswa: items},
                    success:    function() {
                                    location.reload();
                                },

                });
            }
        });

        //column checkbox select all or cancel
        $("input.select-all").click(function () {
            var checked = this.checked;
            $("input.select-item").each(function (index,item) {
                item.checked = checked;
            });
        });

        //check selected items
        $("input.select-item").click(function () {
            var checked = this.checked;
            console.log(checked);
            checkSelected();
        });

        //check is all selected
        function checkSelected() {
            var all = $("input.select-all")[0];
            var total = $("input.select-item").length;
            var len = $("input.select-item:checked:checked").length;
            console.log("total:"+total);
            console.log("len:"+len);
            all.checked = len===total;
        }
    });
</script>
@endsection