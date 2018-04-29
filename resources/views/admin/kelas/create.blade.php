@extends('layouts/app')

@section('content')
@include('layouts/navbar/navbar_admin')
            <div class="content p-4">
                <h1 class="text-center">Form Tambah Kelas</h1>      

                <form action="{{ url('kelas/add') }}" method="POST" id="formTambahKelas">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="nama_kelas" class="col-form-label">Nama Kelas</label>
                        <div class="input-group" id="nama_kelas_nest">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="fas fa-id-badge"></i></div>
                            </div>
                            <input type="text" class="form-control" id="nama_kelas" name="nama_kelas" placeholder="Masukkan nama kelas" value="{{ old('nama_kelas') }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="jurusan" class="col-form-label">Jurusan</label>
                        <div class="row">
                            <div class="col-md-9">
                                <select name="jurusan" id="jurusan" class="form-control">
                                    @foreach($jurusan as $j)
                                        <option value="{{ $j->id_jurusan }}" @if(old('jurusan') == $j->id_jurusan) selected @endif>{{ $j->nama_jurusan }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <div class="btn-group btn-block">
                                    <button class="btn btn-membesar half btn-info" data-toggle="modal" data-target="#modalAddJurusan" data-placement="bottom" title="Tambah Data Jurusan"><i class="fas fa-plus"></i></button>
                                    <button type="button" onclick="editJurusan(btoa($('#jurusan').val()))" class="btn btn-membesar half btn-primary" data-toggle="tooltip" data-placement="bottom" title="Edit Data Jurusan"><i class="fas fa-edit"></i></button>
                                    <button type="button" onclick="deleteJurusan(btoa($('#jurusan').val()))" class="btn btn-membesar half btn-danger" data-toggle="tooltip" data-placement="bottom" title="Delete Data Jurusan"><i class="fas fa-trash"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="btn-group btn-block">
                        <a href="{{ url('kelas') }}" class="btn btn-membesar btn-danger" data-toggle="tooltip" data-placement="bottom" title="Kembali"><i class="fas fa-arrow-left"></i></a>
                        <button type="submit" class="btn btn-membesar btn-primary" data-toggle="tooltip" data-placement="bottom" title="Tambah Data Kelas"><i class="fas fa-plus"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade text-dark" id="modalAddJurusan" tabindex="-1" role="dialog" aria-labelledby="labelAddJurusan" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="labelAddJurusan">Form Tambah Jurusan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ url('jurusan/add') }}" method="POST" id="formTambahJurusan">
                {{ csrf_field() }}
                <div class="modal-body">
                    <div class="form-group">
                        <div class="input-group" id="nama_jurusan_nest">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="fas fa-id-badge"></i></div>
                            </div>
                            <input type="text" class="form-control" id="nama_jurusan" name="nama_jurusan" placeholder="Masukkan nama jurusan" value="{{ old('nama_jurusan') }}">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="btn-group btn-block">  
                        <button type="button" class="btn btn-membesar half btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-membesar half btn-primary"><i class="fas fa-plus"></i></button>
                    </div>
                </div>
            </form>  
        </div>
    </div>
</div>
@endsection

@section('js')
@include('layouts/navbar/navbar_admin_footer')
<script type="text/javascript">
    $(window).on('load', function(){
        $('#sidebar-menu-kelas').addClass('active');
    });

    function editJurusan($id)
    {
        window.location.replace('{{ url("jurusan/edit")}}'+'/'+$id);
    }

    function deleteJurusan($id)
    {
        swal({
            title: 'Hapus data ?',
            text: 'Jika data jurusan dihapus maka data yang bersangkutan akan ikut terhapus.',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Okelah, hapus aja!',
        }).then((result)=>{
            window.location.replace('{{ url("jurusan/delete")}}'+'/'+$id);
        });
    }

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

        $('#formTambahKelas').on('submit', function(e){
            e.preventDefault();
        
            var formData = new FormData();
            formData.set('nama_kelas', $('#nama_kelas').val());
            formData.set('jurusan', $('#jurusan').val());

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

                $('#formTambahKelas').trigger('reset');
                swal('Success', 'Data berhasil ditambahkan!', 'success');
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