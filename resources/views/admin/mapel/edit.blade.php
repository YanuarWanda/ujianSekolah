@extends('layouts/app')

@section('content')
@include('layouts/navbar/navbar_admin')
            <div class="content p-4">
                <h1 class="text-center">Form Edit Mapel</h1>      
            
                <form action="{{ url('mapel/edit', base64_encode($mapel->id_mapel)) }}" method="POST" id="formEditMapel">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="nama_mapel" class="col-form-label">Nama Mapel</label>
                        <div class="input-group" id="nama_mapel_nest">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="fas fa-id-badge"></i></div>
                            </div>
                            <input type="text" class="form-control" id="nama_mapel" name="nama_mapel" placeholder="Masukkan nama mapel" value="{{ $mapel->nama_mapel }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="bidang_keahlian" class="col-form-label">Bidang Keahlian</label>
                        <select name="bidang_keahlian" id="bidang_keahlian" class="form-control">
                            @foreach($bidangKeahlian as $bk)
                                <option value="{{ $bk->id_daftar_bidang }}" @if($mapel->id_daftar_bidang == $bk->id_daftar_bidang) selected @endif>{{ $bk->bidang_keahlian }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="btn-group btn-block">
                        <a href="{{ url('mapel') }}" class="btn btn-membesar btn-danger" data-toggle="tooltip" data-placement="bottom" title="Kembali"><i class="fas fa-arrow-left"></i></a>
                        <button type="submit" class="btn btn-membesar btn-primary" data-toggle="tooltip" data-placement="bottom" title="Update Data Mapel"><i class="fas fa-edit"></i></button>
                    </div>
                </form>
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
        $('#formEditMapel').on('submit', function(e){
            e.preventDefault();

            var formData = new FormData();
            formData.set('nama_mapel', $('#nama_mapel').val());
            formData.set('bidang_keahlian', $('#bidang_keahlian').val());

            axios({
                method: 'post',
                url: this.action,
                data: formData
            }).then(function(response){
                console.log('this is response : ');
                console.log(response);
                const errorMessages = document.querySelectorAll('.text-danger');
                const formControls = document.querySelectorAll('.border-danger');
                if(errorMessages){
                    errorMessages.forEach((element) => element.textContent = '');
                    formControls.forEach((element) => element.classList.remove('border', 'border-danger'));
                }

                swal('Success', 'Data berhasil diubah!', 'success');
            }).catch(function(error){
                console.log('This is error : ');
                console.log(error);
                const errors = error.response.data.errors;
                const firstItem = Object.keys(errors)[0];
                console.log(firstItem);
                const firstItemDOM = document.getElementById(firstItem+'_nest');
                const firstErrorMessage = errors[firstItem][0];

                firstItemDOM.scrollIntoView();

                // hapus error sebelumnya
                const errorMessages = document.querySelectorAll('.text-danger');
                const formControls = document.querySelectorAll('.border-danger');
                errorMessages.forEach((element) => element.textContent = '');
                formControls.forEach((element) => element.classList.remove('border', 'border-danger'));
                
                // menampilkan error
                firstItemDOM.insertAdjacentHTML('afterend', '<div class="text-danger">'+firstErrorMessage+'</div>');
            
                // highlight input jadi merah
                firstItemDOM.classList.add('border', 'border-danger');
            });
        });
    });
</script>
@endsection