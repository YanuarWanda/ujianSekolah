@extends('layouts/app')

@section('content')
@include('layouts/navbar/navbar_admin')
            <div class="content p-4">
                <h1 class="text-center">Form Tambah Jurusan</h1>      

                <form action="{{ url('jurusan/add') }}" method="POST" id="formTambahJurusan">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="nama_jurusan" class="col-form-label">Nama Jurusan</label>
                        <div class="input-group" id="nama_jurusan_nest">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="fas fa-id-badge"></i></div>
                            </div>
                            <input type="text" class="form-control" id="nama_jurusan" name="nama_jurusan" placeholder="Masukkan nama jurusan" value="{{ old('nama_jurusan') }}">
                        </div>
                    </div>

                    <div class="btn-group btn-block">
                        <a href="{{ url('jurusan') }}" class="btn btn-membesar btn-danger" data-toggle="tooltip" data-placement="bottom" title="Kembali"><i class="fas fa-arrow-left"></i></a>
                        <button type="submit" class="btn btn-membesar btn-primary" data-toggle="tooltip" data-placement="bottom" title="Tambah Data Jurusan"><i class="fas fa-plus"></i></button>
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
        $('#sidebar-menu-jurusan').addClass('active');
    });

    $(document).ready(function(){
        $('#formTambahJurusan').on('submit', function(e){
            e.preventDefault();

            var formData = new FormData();
            formData.set('nama_jurusan', $('#nama_jurusan').val());

            axios({
                method: 'post',
                url: this.action,
                data: formData
            }).then(function(response){
                const errorMessages = document.querySelectorAll('.text-danger');
                const formControls = document.querySelectorAll('.border-danger');
                if(errorMessages){
                    errorMessages.forEach((element) => element.textContent = '');
                    formControls.forEach((element) => element.classList.remove('border', 'boder-danger'));
                }

                $('#formTambahJurusan').trigger('reset');
                swal('Success', 'Data berhasil ditambahkan!', 'success');
            }).catch(function(error){
                const errors = error.response.data.errors;
                const firstItem = Object.keys(errors)[0];
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