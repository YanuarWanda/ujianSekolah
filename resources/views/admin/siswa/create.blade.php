@extends('layouts/app')

@section('content')
@include('layouts/navbar/navbar_admin')
            <div class="content p-4">
                <h1 class="text-center">Form Tambah Siswa</h1>
                <form action="{{ url('siswa/add') }}" method="POST" enctype="multipart/form-data" id="formTambahSiswa">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="nis" class="col-form-label">NIS</label>
                        <div class="input-group" id="nis_nest">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="fas fa-id-card"></i></div>
                            </div>
                            <input type="text" class="form-control" id="nis" name="nis" placeholder="Masukkan NIS" value="{{ old('nis') }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="nama" class="col-form-label">Nama</label>
                        <div class="input-group" id="nama_nest">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="fas fa-id-badge"></i></div>
                            </div>
                            <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan nama" value="{{ old('nama') }}">
                        </div>
                    </div>

                    <div class="form-group" id="kelas_nest">
                        <label for="kelas" class="col-form-label">Kelas</label>
                        <select name="kelas" id="kelas" class="form-control">
                            @foreach($kelas as $k)
                                <option value="{{ $k->id_kelas }}" @if(old('kelas') == $k->nama_kelas) selected @endif>{{ $k->nama_kelas }}</option>  
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group" id="alamat_nest">
                        <label for="alamat" class="col-form-label">Alamat</label>
                        <textarea name="alamat" id="alamat" class="form-control">{{ old('alamat') }}</textarea>
                    </div>

                    <div class="form-group" id="jenisKelamin_nest">
                        <label for="jenisKelamin" class="col-form-label">Jenis Kelamin</label>
                        <select name="jenisKelamin" id="jenisKelamin" class="form-control">
                            <option value='L' {{ old('jenisKelamin') == 'L' ? 'selected' : '' }} >Laki-laki</option>
                            <option value='P' {{ old('jenisKelamin') == 'P' ? 'selected' : '' }} >Perempuan</option>
                        </select>
                    </div>

                    <hr>
                    <label for="foto" class="col-form-label">Foto</label>
                    <div class="form-group row">
                        <div class="col-md-3">
                            <img src="{{ asset('image/nophoto.jpg') }}" alt="nophoto" class="img-thumbnail" id="profile-img-tag" width="220px">
                        </div>
                        <div class="custom-file col-md-9">
                            <input type="file" class="custom-file-input" id="foto" name="foto">
                            <label for="foto" class="custom-file-label">Pilih foto ...</label>
                        </div>
                    </div>

                    <hr>
                    <div class="form-group">
                        <label for="username" class="col-form-label">Username</label>
                        <div class="input-group" id="username_nest">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="fas fa-user"></i></div>
                            </div>
                            <input type="text" class="form-control" id="username" name="username" value="{{ old('username') }}" placeholder="Masukkan username">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="email" class="col-form-label">Email</label>
                        <div class="input-group" id="email_nest">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="fas fa-envelope"></i></div>
                            </div>
                            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" placeholder="contoh:yanuar.wanda@gmail.com">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password" class="col-form-label">Password</label>
                        <div class="input-group" id="password_nest">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="fas fa-lock"></i></div>
                            </div>
                            <input type="password" class="form-control" id="password" name="password">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation" class="col-form-label">Konfirmasi Password</label>
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                    </div>

                    <div class="btn-group btn-block">
                        <a href="{{ url('siswa') }}" class="btn btn-membesar btn-danger" data-toggle="tooltip" data-placement="bottom" title="Kembali"><i class="fas fa-arrow-left"></i></a>
                        <button type="submit" class="btn btn-membesar btn-primary" data-toggle="tooltip" data-placement="bottom" title="Tambah Data Siswa"><i class="fas fa-plus"></i></button>
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
        $('#sidebar-menu-siswa').addClass('active');
    });

    $(document).ready(function(){
        $('#formTambahSiswa').on('submit', function(e){
            e.preventDefault();

            var formData = new FormData();
            formData.set('nis', $('#nis').val());
            formData.set('nama', $('#nama').val());
            formData.set('kelas', $('#kelas').val());
            formData.set('alamat', $('#alamat').val());
            formData.set('jenisKelamin', $('#jenisKelamin').val());
            if(document.querySelector('#foto').files[0]){
                formData.set('foto', document.querySelector('#foto').files[0]);
            }
            formData.set('email', $('#email').val());
            formData.set('username', $('#username').val());
            formData.set('password', $('#password').val());
            formData.set('password_confirmation', $('#password_confirmation').val());
            
            axios({
                method: 'post',
                url: this.action,
                data: formData,
                config: { headers: {'Content-Type': 'multipart/form-data'}},
            })
            .then(function(response){
                console.log('this is response : ');
                console.log(response);
                const errorMessages = document.querySelectorAll('.text-danger');
                const formControls = document.querySelectorAll('.border-danger');
                if(errorMessages){
                    errorMessages.forEach((element) => element.textContent = '');
                    formControls.forEach((element) => element.classList.remove('border', 'border-danger'));
                }

                $('#formTambahSiswa').trigger('reset');
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